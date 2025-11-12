# Laravel ERR_TOO_MANY_REDIRECTS Fix

## Problem

In production, Laravel shows:
```
ERR_TOO_MANY_REDIRECTS
```

This happens when Laravel is behind a reverse proxy (Cloudflare, nginx, load balancer, etc.)

## Root Cause

1. **Proxy forwards HTTPS as HTTP**: Proxy receives HTTPS, forwards as HTTP to Laravel
2. **Laravel forces HTTPS**: Sees HTTP, redirects to HTTPS
3. **Loop continues**: Proxy keeps forwarding as HTTP, Laravel keeps redirecting

## Solution ✅

### Fix 1: Trust Proxies Middleware

**File**: `app/Http/Middleware/TrustProxies.php`

```php
// BEFORE
protected $proxies;

// AFTER
protected $proxies = '*'; // Trust all proxies
```

**Why**: Tells Laravel to trust proxy headers (X-Forwarded-Proto, X-Forwarded-For, etc.)

### Fix 2: Smart HTTPS Detection

**File**: `app/Providers/AppServiceProvider.php`

```php
// BEFORE
if (!is_localhost()) {
    \URL::forceScheme('https');
}

// AFTER
$request = request();
$isHttps = $request->secure() || 
          $request->header('X-Forwarded-Proto') === 'https' ||
          $request->server('HTTP_X_FORWARDED_PROTO') === 'https';

if (!$isHttps && !is_localhost()) {
    \URL::forceScheme('https');
}
```

**Why**: Only forces HTTPS if request is NOT already HTTPS (prevents redirect loop)

## Production Configuration

### 1. Environment Variables (.env)

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Session
SESSION_SECURE_COOKIE=true
SESSION_DOMAIN=your-domain.com

# Trust proxies
TRUSTED_PROXIES=*
```

### 2. Clear All Caches

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Then rebuild
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. Web Server Configuration

#### Nginx (Behind Proxy)

```nginx
server {
    listen 80;
    server_name your-domain.com;
    
    # Forward proxy headers
    proxy_set_header X-Forwarded-Proto $scheme;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    
    location / {
        proxy_pass http://127.0.0.1:8000;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header Host $host;
    }
}
```

#### Apache (.htaccess)

Your existing `.htaccess` should work, but ensure mod_rewrite is enabled:

```bash
sudo a2enmod rewrite
sudo a2enmod headers
sudo systemctl restart apache2
```

### 4. Cloudflare Configuration

If using Cloudflare:

1. **SSL/TLS Mode**: Set to "Full" or "Full (strict)"
2. **Always Use HTTPS**: Enable
3. **Automatic HTTPS Rewrites**: Enable

## Testing

### Test 1: Check HTTPS Detection

```bash
# In Laravel Tinker
php artisan tinker

# Check if HTTPS is detected
request()->secure()
request()->header('X-Forwarded-Proto')
```

### Test 2: Check TrustProxies

```bash
# Should return proxy IP, not client IP
request()->ip()
request()->getClientIp()
```

### Test 3: Test Redirect

1. Visit: `http://your-domain.com` (without HTTPS)
2. Should redirect to: `https://your-domain.com` (once)
3. Should NOT loop

## Common Issues

### Issue: Still Getting Redirects

**Solution**:
```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear

# Restart web server
sudo systemctl restart nginx
# or
sudo systemctl restart apache2
```

### Issue: HTTPS Not Detected

**Check**:
1. TrustProxies middleware is loaded
2. Proxy headers are being sent
3. `X-Forwarded-Proto` header exists

**Debug**:
```php
// In AppServiceProvider, add logging
\Log::info('HTTPS Check', [
    'secure' => request()->secure(),
    'x-forwarded-proto' => request()->header('X-Forwarded-Proto'),
    'server' => request()->server('HTTP_X_FORWARDED_PROTO'),
]);
```

### Issue: Session Issues After Fix

**Solution**:
```env
SESSION_SECURE_COOKIE=true
SESSION_DOMAIN=your-domain.com
```

Then clear session cache:
```bash
php artisan session:clear
```

## Verification Checklist

After deploying fixes:

- [ ] No redirect loop when accessing site
- [ ] HTTPS works correctly
- [ ] HTTP redirects to HTTPS (once)
- [ ] Sessions work correctly
- [ ] Cookies are secure
- [ ] API endpoints work
- [ ] Desktop app can connect

## Files Modified

1. ✅ `app/Http/Middleware/TrustProxies.php` - Trust all proxies
2. ✅ `app/Providers/AppServiceProvider.php` - Smart HTTPS detection

## Summary

The redirect loop was caused by:
1. Laravel not trusting proxy headers
2. Forcing HTTPS without checking if already HTTPS

**Fixed by**:
1. Trusting all proxies in TrustProxies middleware
2. Checking if request is already HTTPS before forcing it

**Result**: No more redirect loops! ✅

## Quick Deploy

```bash
# 1. Pull latest code
git pull

# 2. Clear caches
php artisan config:clear
php artisan cache:clear

# 3. Rebuild caches
php artisan config:cache
php artisan route:cache

# 4. Restart web server
sudo systemctl restart nginx
```

The redirect loop should be fixed now! 🎉

