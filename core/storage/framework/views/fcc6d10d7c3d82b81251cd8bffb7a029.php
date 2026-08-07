<?php
    $customCaptcha = loadCustomCaptcha();
    $googleCaptcha = loadReCaptcha();
?>
<?php if($googleCaptcha): ?>
    <div class="mt-4">
        <?php echo $googleCaptcha ?>
    </div>
<?php endif; ?>

<?php if($customCaptcha): ?>
    <div class="col-sm-12 mt-4">
        <?php echo $customCaptcha ?>
    </div>
    <div class="col-sm-12 mt-4">
        <div class="input--group">
            <input name="captcha" type="text" id="captcha" class="form-control form--control" required>
            <label class="form--label" for="captcha"><?php echo app('translator')->get('Captcha'); ?></label>
        </div>
    </div>
<?php endif; ?>

<?php if($googleCaptcha): ?>
    <?php $__env->startPush('script'); ?>
        <script>
            (function($) {
                "use strict"
                $('.verify-gcaptcha').on('submit', function() {
                    var response = grecaptcha.getResponse();
                    if (response.length == 0) {
                        document.getElementById('g-recaptcha-error').innerHTML =
                            '<span class="text-danger"><?php echo app('translator')->get('Captcha field is required.'); ?></span>';
                        return false;
                    }
                    return true;
                });
            })(jQuery);
        </script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/partials//captcha.blade.php ENDPATH**/ ?>