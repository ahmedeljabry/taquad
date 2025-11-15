<?php if (! $__env->hasRenderedOnce('ecac5780-14c7-494d-bc16-f12f3f37bd9a')): $__env->markAsRenderedOnce('ecac5780-14c7-494d-bc16-f12f3f37bd9a'); ?>
    <?php
        $phosphorVersion = '2.1.1';
        $phosphorWeights = [
            'regular' => 'Phosphor',
            'thin' => 'Phosphor-Thin',
            'light' => 'Phosphor-Light',
            'bold' => 'Phosphor-Bold',
            'fill' => 'Phosphor-Fill',
            'duotone' => 'Phosphor-Duotone',
        ];
    ?>

    <?php $__currentLoopData = $phosphorWeights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weight => $fontFamily): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $relativeCssPath = "vendor/phosphor/{$weight}/style.css";
            $localCssPath = public_path($relativeCssPath);
            $hasLocalAssets = is_file($localCssPath);
            $cdnBase = "https://unpkg.com/@phosphor-icons/web@{$phosphorVersion}/src/{$weight}";
            $cdnCss = "{$cdnBase}/style.css";
        ?>

        <?php if($hasLocalAssets): ?>
            <link rel="preload" href="<?php echo e(asset($relativeCssPath), false); ?>" as="style">
            <link rel="stylesheet" href="<?php echo e(asset($relativeCssPath), false); ?>">
        <?php else: ?>
            <link rel="preload" href="<?php echo e($cdnCss, false); ?>" as="style" crossorigin="anonymous">
            <link rel="stylesheet" href="<?php echo e($cdnCss, false); ?>" crossorigin="anonymous">
            <style>
                @font-face {
                    font-family: "<?php echo e($fontFamily, false); ?>";
                    src:
                        url("<?php echo e($cdnBase, false); ?>/<?php echo e($fontFamily, false); ?>.woff2") format("woff2"),
                        url("<?php echo e($cdnBase, false); ?>/<?php echo e($fontFamily, false); ?>.woff") format("woff"),
                        url("<?php echo e($cdnBase, false); ?>/<?php echo e($fontFamily, false); ?>.ttf") format("truetype"),
                        url("<?php echo e($cdnBase, false); ?>/<?php echo e($fontFamily, false); ?>.svg#<?php echo e($fontFamily, false); ?>") format("svg");
                    font-weight: normal;
                    font-style: normal;
                    font-display: swap;
                }
            </style>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/components/phosphor/styles.blade.php ENDPATH**/ ?>