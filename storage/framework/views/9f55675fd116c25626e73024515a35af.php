<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo e(config('app.name'), false); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    .button-blue,
    .button-primary {
        background-color: <?php echo e(settings('appearance')->colors['primary'], false); ?>;
    }
    .logo {
        background-color: #ffffff !important;
        border-bottom   : 1px solid #f8f8f8 !important;
        padding         : 25px 5px !important;
    }

@media only screen and (max-width: 600px) {
.inner-body {
    width: 100% !important;
    }

.footer {
width: 100% !important;
}
}

@media only screen and (max-width: 500px) {
.button {
width: 100% !important;
}
}
</style>
</head>
<body>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<?php echo e($header ?? '', false); ?>


<!-- Email Body -->
<tr>
<td class="body" width="100%" cellpadding="0" cellspacing="0" style="border: hidden !important;">
<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom: 30px">
<!-- Body content -->
<tr>
<td class="content-cell">
    
    
    <a href="<?php echo e(url('/'), false); ?>" class="h-full logo">
        <img src="<?php echo e(src(settings('general')->logo), false); ?>">
    </a>
    
    
    <div style="padding: 32px">
        
        <?php echo e(Illuminate\Mail\Markdown::parse($slot), false); ?>

        
        <?php echo e($subcopy ?? '', false); ?>

        
    </div>
</td>
</tr>
</table>
</td>
</tr>

<?php echo e($footer ?? '', false); ?>


</table>
</td>
</tr>
</table>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/vendor/mail/html/layout.blade.php ENDPATH**/ ?>