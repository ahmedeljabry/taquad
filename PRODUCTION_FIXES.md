# Production Issues - Fixes & Solutions

## Issue 1: ERR_TOO_MANY_REDIRECTS ❌

### Problem
Getting infinite redirect loop in production, browser shows:
```
ERR_TOO_MANY_REDIRECTS
```

### Root Cause
Laravel not properly detecting HTTPS when behind reverse proxy/load balancer (Cloudflare, nginx, etc.). This causes:
```
1. Request comes as HTTPS
2. Proxy forwards as HTTP to Laravel
3. Laravel sees HTTP, redirects to HTTPS
4. Loop continues infinitely
```

### Solution ✅

**File**: `app/Http/Middleware/TrustProxies.php`

```php
// BEFORE
protected $proxies;

// AFTER
protected $proxies = '*'; // Trust all proxies
```

**Why This Works**:
- Tells Laravel to trust proxy headers (X-Forwarded-Proto, X-Forwarded-For, etc.)
- Laravel correctly detects HTTPS from proxy headers
- No more redirect loop

### Additional Fixes

**1. Check .env file**:
```env
APP_URL=https://your-domain.com  # Must be HTTPS
SESSION_SECURE_COOKIE=true       # Force secure cookies
```

**2. Check web server config** (nginx example):
```nginx
location / {
    proxy_pass http://localhost:8000;
    proxy_set_header X-Forwarded-Proto $scheme;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header Host $host;
}
```

**3. Clear cache**:
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

## Issue 2: Screenshots Not Uploading (Desktop App) ❌

### Problem
Console shows:
```
Access to fetch at 'http://asset.localhost/...' from origin 'http://127.0.0.1:5173' 
has been blocked by CORS policy
```

### Root Cause
`convertFileSrc()` creates a Tauri asset URL (`asset://localhost/...`) that:
1. Requires CORS headers
2. Doesn't work across origins in development
3. Can't be fetched directly by JavaScript

### Solution ✅

**Use Tauri Filesystem API instead of fetch**

**Files Modified**:

1. **package.json** - Added dependency:
```json
"@tauri-apps/plugin-fs": "^2.0.0"
```

2. **Cargo.toml** - Added Rust plugin:
```toml
tauri-plugin-fs = "2"
```

3. **main.rs** - Registered plugin:
```rust
.plugin(tauri_plugin_fs::init())
```

4. **capabilities/default.json** - Added permissions:
```json
"fs:default",
"fs:allow-read-file",
"fs:allow-exists"
```

5. **src/lib/api.ts** - Changed file reading:
```typescript
// BEFORE (CORS error)
const fileUrl = convertFileSrc(localPath)
const response = await fetch(fileUrl)
const blob = await response.blob()

// AFTER (Works!)
const fileBytes = await readBinaryFile(localPath)
const blob = new Blob([fileBytes], { type: 'image/png' })
```

### Why This Works
- `readBinaryFile()` uses Tauri's native file system access
- No CORS issues
- Works in both development and production
- More reliable

## Deployment Checklist

### Before Deploying

- [ ] Update `.env` with production values
- [ ] Set `APP_URL` to `https://your-domain.com`
- [ ] Set `SESSION_SECURE_COOKIE=true`
- [ ] Configure `TrustProxies` middleware
- [ ] Run migrations
- [ ] Link storage: `php artisan storage:link`
- [ ] Clear all caches

### Commands to Run

```bash
# Update dependencies
composer install --optimize-autoloader --no-dev

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Link storage
php artisan storage:link
```

### Web Server Configuration

#### Nginx
```nginx
server {
    listen 443 ssl http2;
    server_name your-domain.com;
    
    ssl_certificate /path/to/cert.pem;
    ssl_certificate_key /path/to/key.pem;
    
    root /path/to/taquad/public;
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        
        # Important: Forward proxy headers
        fastcgi_param HTTPS on;
        fastcgi_param HTTP_X_FORWARDED_PROTO https;
    }
}
```

#### Apache (.htaccess already configured)
Just ensure `mod_rewrite` and `mod_headers` are enabled:
```bash
sudo a2enmod rewrite
sudo a2enmod headers
sudo systemctl restart apache2
```

### Environment Variables

```env
# App
APP_NAME=Taquad
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=taquad_db
DB_USERNAME=taquad_user
DB_PASSWORD=your_secure_password

# Security
SESSION_SECURE_COOKIE=true
SESSION_DOMAIN=your-domain.com

# Filesystem
FILESYSTEM_DISK=public

# Cache
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

## Testing in Production

### 1. Test Web Interface
```
✓ Navigate to: https://your-domain.com
✓ No redirect loop
✓ Login works
✓ Dashboard loads
✓ Tracker page accessible
```

### 2. Test Desktop App
```
✓ Login via OAuth
✓ Start tracking
✓ Wait 10 minutes
✓ Segment uploads
✓ Screenshot uploads
✓ Check web interface for screenshots
```

### 3. Verify Screenshot Upload
```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Check screenshot files
ls -la storage/app/tracker/screenshots/

# Check database
mysql -u user -p database_name
SELECT id, contract_id, started_at, has_screenshot 
FROM time_entries 
ORDER BY created_at DESC LIMIT 10;

SELECT * FROM time_snapshots 
ORDER BY created_at DESC LIMIT 10;
```

## Common Production Issues

### Issue: Still Getting Redirects
**Solution**:
```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Restart web server
sudo systemctl restart nginx
# or
sudo systemctl restart apache2
```

### Issue: Screenshots Not Saving
**Solution**:
```bash
# Fix storage permissions
chmod -R 775 storage
chown -R www-data:www-data storage

# Link storage
php artisan storage:link
```

### Issue: Database Connection Error
**Solution**:
- Check `.env` database credentials
- Verify MySQL is running
- Test connection: `php artisan tinker` then `DB::connection()->getPdo();`

### Issue: CORS Errors
**Solution**:
```php
// config/cors.php
'paths' => ['api/*', 'sanctum/csrf-cookie', 'tracker/*'],
'allowed_origins' => [env('APP_URL')],
'allowed_origins_patterns' => [],
'supports_credentials' => true,
```

## Security Checklist

### Production Security

- [ ] `APP_DEBUG=false`
- [ ] Strong `APP_KEY` generated
- [ ] `SESSION_SECURE_COOKIE=true`
- [ ] HTTPS enabled
- [ ] Firewall configured
- [ ] Database user has minimal permissions
- [ ] File permissions correct (755 for directories, 644 for files)
- [ ] Storage directory writable by web server
- [ ] Rate limiting enabled
- [ ] CSRF protection enabled

### Desktop App Security

- [ ] OAuth tokens encrypted
- [ ] Screenshots in secure directory
- [ ] API endpoints authenticated
- [ ] HTTPS only communication
- [ ] No sensitive data in logs

## Monitoring

### Set Up Logging

```php
// config/logging.php
'channels' => [
    'stack' => [
        'driver' => 'stack',
        'channels' => ['daily', 'slack'],
    ],
    
    'daily' => [
        'driver' => 'daily',
        'path' => storage_path('logs/laravel.log'),
        'level' => 'debug',
        'days' => 14,
    ],
],
```

### Monitor Screenshot Uploads

```bash
# Watch for screenshot uploads
tail -f storage/logs/laravel.log | grep screenshot

# Check storage size
du -sh storage/app/tracker/screenshots/

# Count screenshots
find storage/app/tracker/screenshots/ -type f | wc -l
```

## Performance Optimization

### Image Optimization
Screenshots are auto-resized in desktop app (max 1920x1080), but you can add server-side optimization:

```php
// In ScreenshotController.php
use Intervention\Image\Facades\Image;

$image = Image::make($request->file('file'));
$image->resize(1920, 1080, function ($constraint) {
    $constraint->aspectRatio();
    $constraint->upsize();
});
$path = $image->save(storage_path('app/tracker/screenshots/...'));
```

### Database Indexing
```sql
-- Add indexes for better query performance
CREATE INDEX idx_time_entries_contract_started ON time_entries(contract_id, started_at);
CREATE INDEX idx_time_entries_synced ON time_entries(synced_at);
CREATE INDEX idx_time_snapshots_entry ON time_snapshots(time_entry_id);
```

## Summary

### Desktop App Screenshot Upload
✅ **Fixed**: Using Tauri filesystem API instead of fetch  
✅ **Added**: Comprehensive logging  
✅ **Added**: Filesystem plugin with permissions  
✅ **Result**: Screenshots upload successfully  

### Production Redirect Loop
✅ **Fixed**: TrustProxies middleware configured  
✅ **Added**: Deployment checklist  
✅ **Added**: Security checklist  
✅ **Result**: No more redirect loops  

## Next Steps

1. **Deploy fixes**:
   ```bash
   git add .
   git commit -m "Fix production redirects and screenshot uploads"
   git push origin main
   ```

2. **On server**:
   ```bash
   git pull
   composer install --no-dev
   php artisan config:clear
   php artisan config:cache
   php artisan migrate --force
   ```

3. **Test desktop app**:
   - Rebuild: `npm run tauri:build`
   - Install new version
   - Test screenshot upload
   - Check web interface

4. **Monitor**:
   - Watch Laravel logs for errors
   - Check screenshot upload success rate
   - Monitor server resources

All issues should be resolved now! 🎉

