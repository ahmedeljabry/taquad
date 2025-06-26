<form method="<?php echo e($spoofMethod ? 'POST' : $method, false); ?>"
      <?php if($action): ?>
          action="<?php echo e($action, false); ?>"
      <?php endif; ?>

     <?php if($hasFiles): ?>
         enctype="multipart/form-data"
     <?php endif; ?>

     <?php if (! ($spellcheck)): ?>
         spellcheck="false"
     <?php endif; ?>

     <?php echo e($attributes, false); ?>

>
    <?php if (! (in_array($method, ['HEAD', 'GET', 'OPTIONS'], true))): ?>
        <?php echo csrf_field(); ?>
    <?php endif; ?>

    <?php if($spoofMethod): ?>
        <?php echo method_field($method); ?>
    <?php endif; ?>

    <?php echo e($slot, false); ?>

</form>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/vendor/form-components/components/form.blade.php ENDPATH**/ ?>