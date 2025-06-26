<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    // determines types of icon to display. Available options: info, success, error, warning
    // only the blank type (type='') has no icon. useful if you want your modal to contain a form 
    // or other custom content
    'type' => '',

    // title text to display. example: Confirm your delete action
    'title' => '',

    // name of the modal. used to uniquely identify the modal in css and js
    'name' => 'amodal',

    // text to display on primary button. default is Okay
    'ok_button_label' => 'Okay',
    'okButtonLabel' => 'Okay',

    // text to display on secondary button. default is Cancel
    'cancel_button_label' => 'Cancel',
    'cancelButtonLabel' => 'Cancel',

    // action to perform when secondary button is clicked. default is close. 
    // provide a custom js function as string to execute that function. example "saveUser"
    'ok_button_action' => 'close',
    'okButtonAction' => 'close',

    // action to perform when primary button is clicked. default is close. 
    // provide a custom js function as a string to execute that function. example "confirmAction"
    'cancel_button_action' => 'close',
    'cancelButtonAction' => 'close',

    // close modal when either primary or close secondary buttons are clicked
    // the modal will be closed after your custom js function has been executed
    'close_after_action' => true,
    'closeAfterAction' => true,

    // determines if clicking on the backdrop can close the modal. default is true
    // when set to false, only the action buttons can close the modal.
    // in this case ensure you have set "close" as an action for one of your action buttons
    'backdrop_can_close' => true,
    'backdropCanClose' => true,

    // should the action buttons be displayed? default is true. false will hide the buttons
    'show_action_buttons' => true,
    'showActionButtons' => true,

    // should the action buttons be centered? default is false. right aligned
    'center_action_buttons' => false,
    'centerActionButtons' => false,

    // should the action buttons stretch the entire width of the modal
    'stretch_action_buttons' => false,
    'stretchActionButtons' => false,

    // should the backdrop of the modal be blurred
    'blur_backdrop' => true,
    'blurBackdrop' => true,

    // determines size of the modal. available options are small, medium, large and xl
    // on mobile it is small by default but fills up the width of the screen
    'size' => 'big',
    'sizes' => [
        'tiny' => 'w-1/6',
        'small' => 'w-1/5',
        'medium' => 'w-1/4',
        'big' => 'w-1/3',
        'large' => 'w-2/5',
        'xl' => 'w-2/3',
        'omg' => 'w-11/12'
    ],
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    // determines types of icon to display. Available options: info, success, error, warning
    // only the blank type (type='') has no icon. useful if you want your modal to contain a form 
    // or other custom content
    'type' => '',

    // title text to display. example: Confirm your delete action
    'title' => '',

    // name of the modal. used to uniquely identify the modal in css and js
    'name' => 'amodal',

    // text to display on primary button. default is Okay
    'ok_button_label' => 'Okay',
    'okButtonLabel' => 'Okay',

    // text to display on secondary button. default is Cancel
    'cancel_button_label' => 'Cancel',
    'cancelButtonLabel' => 'Cancel',

    // action to perform when secondary button is clicked. default is close. 
    // provide a custom js function as string to execute that function. example "saveUser"
    'ok_button_action' => 'close',
    'okButtonAction' => 'close',

    // action to perform when primary button is clicked. default is close. 
    // provide a custom js function as a string to execute that function. example "confirmAction"
    'cancel_button_action' => 'close',
    'cancelButtonAction' => 'close',

    // close modal when either primary or close secondary buttons are clicked
    // the modal will be closed after your custom js function has been executed
    'close_after_action' => true,
    'closeAfterAction' => true,

    // determines if clicking on the backdrop can close the modal. default is true
    // when set to false, only the action buttons can close the modal.
    // in this case ensure you have set "close" as an action for one of your action buttons
    'backdrop_can_close' => true,
    'backdropCanClose' => true,

    // should the action buttons be displayed? default is true. false will hide the buttons
    'show_action_buttons' => true,
    'showActionButtons' => true,

    // should the action buttons be centered? default is false. right aligned
    'center_action_buttons' => false,
    'centerActionButtons' => false,

    // should the action buttons stretch the entire width of the modal
    'stretch_action_buttons' => false,
    'stretchActionButtons' => false,

    // should the backdrop of the modal be blurred
    'blur_backdrop' => true,
    'blurBackdrop' => true,

    // determines size of the modal. available options are small, medium, large and xl
    // on mobile it is small by default but fills up the width of the screen
    'size' => 'big',
    'sizes' => [
        'tiny' => 'w-1/6',
        'small' => 'w-1/5',
        'medium' => 'w-1/4',
        'big' => 'w-1/3',
        'large' => 'w-2/5',
        'xl' => 'w-2/3',
        'omg' => 'w-11/12'
    ],
]); ?>
<?php foreach (array_filter(([
    // determines types of icon to display. Available options: info, success, error, warning
    // only the blank type (type='') has no icon. useful if you want your modal to contain a form 
    // or other custom content
    'type' => '',

    // title text to display. example: Confirm your delete action
    'title' => '',

    // name of the modal. used to uniquely identify the modal in css and js
    'name' => 'amodal',

    // text to display on primary button. default is Okay
    'ok_button_label' => 'Okay',
    'okButtonLabel' => 'Okay',

    // text to display on secondary button. default is Cancel
    'cancel_button_label' => 'Cancel',
    'cancelButtonLabel' => 'Cancel',

    // action to perform when secondary button is clicked. default is close. 
    // provide a custom js function as string to execute that function. example "saveUser"
    'ok_button_action' => 'close',
    'okButtonAction' => 'close',

    // action to perform when primary button is clicked. default is close. 
    // provide a custom js function as a string to execute that function. example "confirmAction"
    'cancel_button_action' => 'close',
    'cancelButtonAction' => 'close',

    // close modal when either primary or close secondary buttons are clicked
    // the modal will be closed after your custom js function has been executed
    'close_after_action' => true,
    'closeAfterAction' => true,

    // determines if clicking on the backdrop can close the modal. default is true
    // when set to false, only the action buttons can close the modal.
    // in this case ensure you have set "close" as an action for one of your action buttons
    'backdrop_can_close' => true,
    'backdropCanClose' => true,

    // should the action buttons be displayed? default is true. false will hide the buttons
    'show_action_buttons' => true,
    'showActionButtons' => true,

    // should the action buttons be centered? default is false. right aligned
    'center_action_buttons' => false,
    'centerActionButtons' => false,

    // should the action buttons stretch the entire width of the modal
    'stretch_action_buttons' => false,
    'stretchActionButtons' => false,

    // should the backdrop of the modal be blurred
    'blur_backdrop' => true,
    'blurBackdrop' => true,

    // determines size of the modal. available options are small, medium, large and xl
    // on mobile it is small by default but fills up the width of the screen
    'size' => 'big',
    'sizes' => [
        'tiny' => 'w-1/6',
        'small' => 'w-1/5',
        'medium' => 'w-1/4',
        'big' => 'w-1/3',
        'large' => 'w-2/5',
        'xl' => 'w-2/3',
        'omg' => 'w-11/12'
    ],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<?php
    // reset variables for Laravel 8 support
    if ($okButtonLabel !== $ok_button_label) $ok_button_label = $okButtonLabel;
    if ($okButtonAction !== $ok_button_action) $ok_button_action = $okButtonAction;
    if ($cancelButtonLabel !== $cancel_button_label) $cancel_button_label = $cancelButtonLabel;
    if ($cancelButtonAction !== $cancel_button_action) $cancel_button_action = $cancelButtonAction;

    $close_after_action = filter_var($close_after_action, FILTER_VALIDATE_BOOLEAN);
    $closeAfterAction = filter_var($closeAfterAction, FILTER_VALIDATE_BOOLEAN);
    $backdrop_can_close = filter_var($backdrop_can_close, FILTER_VALIDATE_BOOLEAN);
    $backdropCanClose = filter_var($backdropCanClose, FILTER_VALIDATE_BOOLEAN);
    $show_action_buttons = filter_var($show_action_buttons, FILTER_VALIDATE_BOOLEAN);
    $showActionButtons = filter_var($showActionButtons, FILTER_VALIDATE_BOOLEAN);
    $center_action_buttons = filter_var($center_action_buttons, FILTER_VALIDATE_BOOLEAN);
    $centerActionButtons = filter_var($centerActionButtons, FILTER_VALIDATE_BOOLEAN);
    $stretch_action_buttons = filter_var($stretch_action_buttons, FILTER_VALIDATE_BOOLEAN);
    $stretchActionButtons = filter_var($stretchActionButtons, FILTER_VALIDATE_BOOLEAN);
    $blur_backdrop = filter_var($blur_backdrop, FILTER_VALIDATE_BOOLEAN);
    $blurBackdrop = filter_var($blurBackdrop, FILTER_VALIDATE_BOOLEAN);

    if (!$closeAfterAction) $close_after_action = $closeAfterAction;
    if (!$backdropCanClose) $backdrop_can_close = $backdropCanClose;
    if (!$showActionButtons) $show_action_buttons = $showActionButtons;
    if ($centerActionButtons) $center_action_buttons = $centerActionButtons;
    if ($stretchActionButtons) $stretch_action_buttons = $stretchActionButtons;
    if ($blurBackdrop) $blur_backdrop = $blurBackdrop;
    //-------------------------------------------------------------------

    $name = str_replace(' ', '-', $name);
    $cancelCss = ($cancel_button_label == '') ? 'hidden' : '';
    $okCss = ($ok_button_label == '') ? 'hidden' : '';
    $okAction = $cancelAction = "hideModal('{$name}')";
    if($ok_button_action !== 'close') $okAction = $ok_button_action . (($close_after_action) ? ';'.$okAction : '');
    if($cancel_button_action !== 'close') $cancelAction = $cancel_button_action . (($close_after_action) ? ';'.$cancelAction : '');
    $button_size = ($size == 'tiny') ? 'tiny' : 'small';
?>

<span class="sm:w-1/6 sm:w-1/5 sm:w-1/4 sm:w-1/3 sm:w-2/5 sm:w-2/3 sm:w-11/12"></span>

<div data-name="<?php echo e($name, false); ?>" data-backdrop-can-close="<?php echo e($backdrop_can_close, false); ?>"
    class="w-full h-full bg-black/40 fixed left-0 top-0 <?php if($blur_backdrop): ?> backdrop-blur-md <?php endif; ?> z-[80] flex bw-modal bw-<?php echo e($name, false); ?>-modal hidden">
    <div class="sm:<?php echo e($sizes[$size], false); ?> w-full p-4 m-auto bw-<?php echo e($name, false); ?> animate__faster">
        <div class="bg-white dark:bg-slate-900 dark:border dark:border-slate-800 rounded-lg drop-shadow-2xl">
            <div class="<?php echo e((!empty($type))?'flex':'flex-initial', false); ?>">
                <?php if(!empty($type)): ?>
                <div class="modal-icon py-6 pl-6 grow-0">
                    <?php if (isset($component)) { $__componentOriginal0bccc847fd1e63f36e1c987b5a424c67 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0bccc847fd1e63f36e1c987b5a424c67 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bladewind.modal-icon','data' => ['type' => ''.e($type, false).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bladewind.modal-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => ''.e($type, false).'']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0bccc847fd1e63f36e1c987b5a424c67)): ?>
<?php $attributes = $__attributesOriginal0bccc847fd1e63f36e1c987b5a424c67; ?>
<?php unset($__attributesOriginal0bccc847fd1e63f36e1c987b5a424c67); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0bccc847fd1e63f36e1c987b5a424c67)): ?>
<?php $component = $__componentOriginal0bccc847fd1e63f36e1c987b5a424c67; ?>
<?php unset($__componentOriginal0bccc847fd1e63f36e1c987b5a424c67); ?>
<?php endif; ?>
                </div>
               <?php endif; ?>
                <div class="modal-body grow p-6">
                    <h1 class="text-2xl font-medium text-gray-800 dark:text-slate-300 modal-title text-left"><?php echo e($title, false); ?></h1>
                    <div class="modal-text text-gray-600 dark:text-gray-400 pt-2 text-base leading-6 tracking-wide text-left">
                        <?php echo e($slot, false); ?>

                    </div>
                </div>
            </div>
            <?php if( $show_action_buttons ): ?>
                <div class="modal-footer <?php if($center_action_buttons || in_array($size, ['tiny', 'small', 'medium'])): ?> text-center <?php else: ?> text-right <?php endif; ?> bg-gray-100 dark:bg-slate-800/50 dark:border-t dark:border-slate-800 py-3 px-6 rounded-br-lg rounded-bl-lg">
                    <?php if (isset($component)) { $__componentOriginal9a524495f8fba1bb9db48a43313dffc1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a524495f8fba1bb9db48a43313dffc1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bladewind.button.index','data' => ['type' => 'secondary','size' => ''.e($button_size, false).'','onclick' => ''.$cancelAction.'','class' => 'cancel '.e((($stretch_action_buttons) ? 'block w-full mb-3' : ''), false).' '.e($cancelCss, false).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bladewind.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'secondary','size' => ''.e($button_size, false).'','onclick' => ''.$cancelAction.'','class' => 'cancel '.e((($stretch_action_buttons) ? 'block w-full mb-3' : ''), false).' '.e($cancelCss, false).'']); ?><?php echo e($cancel_button_label, false); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a524495f8fba1bb9db48a43313dffc1)): ?>
<?php $attributes = $__attributesOriginal9a524495f8fba1bb9db48a43313dffc1; ?>
<?php unset($__attributesOriginal9a524495f8fba1bb9db48a43313dffc1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a524495f8fba1bb9db48a43313dffc1)): ?>
<?php $component = $__componentOriginal9a524495f8fba1bb9db48a43313dffc1; ?>
<?php unset($__componentOriginal9a524495f8fba1bb9db48a43313dffc1); ?>
<?php endif; ?>
                        
                    <?php if (isset($component)) { $__componentOriginal9a524495f8fba1bb9db48a43313dffc1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a524495f8fba1bb9db48a43313dffc1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bladewind.button.index','data' => ['size' => ''.e($button_size, false).'','onclick' => ''.$okAction.'','class' => 'okay '.e((($stretch_action_buttons) ? 'block w-full mb-3 !ml-0' : 'ml-3'), false).' '.e($okCss, false).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bladewind.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => ''.e($button_size, false).'','onclick' => ''.$okAction.'','class' => 'okay '.e((($stretch_action_buttons) ? 'block w-full mb-3 !ml-0' : 'ml-3'), false).' '.e($okCss, false).'']); ?><?php echo e($ok_button_label, false); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a524495f8fba1bb9db48a43313dffc1)): ?>
<?php $attributes = $__attributesOriginal9a524495f8fba1bb9db48a43313dffc1; ?>
<?php unset($__attributesOriginal9a524495f8fba1bb9db48a43313dffc1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a524495f8fba1bb9db48a43313dffc1)): ?>
<?php $component = $__componentOriginal9a524495f8fba1bb9db48a43313dffc1; ?>
<?php unset($__componentOriginal9a524495f8fba1bb9db48a43313dffc1); ?>
<?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        dom_el('.bw-<?php echo e($name, false); ?>-modal').addEventListener('click', function (e){ 
            let backdrop_can_close = this.getAttribute('data-backdrop-can-close');
            if(backdrop_can_close) hideModal('<?php echo e($name, false); ?>');
        });

        dom_el('.bw-<?php echo e($name, false); ?>').addEventListener('click', function (e){ 
            e.stopImmediatePropagation(); 
        });

        if(dom_els('.bw-<?php echo e($name, false); ?>-modal .modal-footer>button')){
            dom_els('.bw-<?php echo e($name, false); ?>-modal .modal-footer>button').forEach((el) => {
                el.addEventListener('click', function (e){ e.stopImmediatePropagation(); });
            });
        }

        document.addEventListener('keyup', function(e){
            if(e.key === "Escape") {
                if(current_modal !== undefined && current_modal.length > 0) {
                    let modal_name = current_modal[current_modal.length];
                    if(dom_el(modal_name).getAttribute('data-backdrop-can-close')) hideModal(modal_name);
                }
            }
        })
    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\taquad\resources\views/components/bladewind/modal.blade.php ENDPATH**/ ?>