<?php
    use App\Constants\Status;$packageContent = getContent('package.content', true);
    $gatewayCurrency = \App\Models\GatewayCurrency::whereHas('method', function ($gate) {
        $gate->where('status', Status::ENABLE);
    })
        ->with('method')
        ->orderby('method_code')
        ->get();
?>
<div class="section pricing-plan section--bg">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-xl-6">
                    <h2 class="mt-0 text-center"><?php echo e(__(@$packageContent->data_values->heading)); ?></h2>
                    <p class="section__para mx-auto mb-0 text-center">
                        <?php echo e(__(@$packageContent->data_values->subheading)); ?>

                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row g-4 g-xl-3 g-xxl-4 justify-content-center">
            <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-xl-3">
                    <div class="plan">
                        <div class="plan__head">
                            <div class="plan__head-content">
                                <h4 class="text--white mt-0 mb-0 text-center"><?php echo e(__($package->name)); ?></h4>
                            </div>
                        </div>
                        <div class="plan__body">
                            <div class="text-center">
                                <h5 class="plan__body-price m-0 text-center"><?php echo e(showAmount($package->price)); ?>

                                   </h5>
                            </div>
                            <ul class="list list--base">
                                <li>
                                    <i class="text--base <?php if($package->validity_period): ?> fas fa-check <?php else: ?> fas fa-times <?php endif; ?>"></i>
                                    <?php echo app('translator')->get('Duration'); ?> <?php echo e(packageLimitation($package)['validity_period']); ?>

                                </li>

                                <li>
                                    <i class="text--base <?php if($package->contact_view_limit): ?> fas fa-check <?php else: ?> fas fa-times <?php endif; ?>"></i>
                                    <?php echo app('translator')->get('Contact View'); ?> <?php echo e(packageLimitation($package)['contact_view_limit']); ?>

                                </li>

                                <li>
                                    <i class="text--base <?php if($package->interest_express_limit): ?> fas fa-check <?php else: ?> fas fa-times <?php endif; ?>"></i>
                                    <?php echo app('translator')->get('Interest Express'); ?> <?php echo e(packageLimitation($package)['interest_express_limit']); ?>

                                </li>

                                <li>
                                    <i class="text--base <?php if($package->image_upload_limit): ?> fas fa-check <?php else: ?> fas fa-times <?php endif; ?>"></i>
                                    <?php echo app('translator')->get('Image Upload'); ?> <?php echo e(packageLimitation($package)['image_upload_limit']); ?>

                                </li>
                            </ul>
                            <div class="mt-3 text-center">
                                <?php if($package->id == (gs('default_package_id'))): ?>
                                    <button class="btn btn--base sm-text" type="button" disabled>
                                        <?php echo app('translator')->get('Buy Now'); ?> </button>
                                <?php else: ?>
                                    <button class="btn btn--base sm-text packageBtn boostBtn" data-package_id="<?php echo e($package->id); ?>"
                                            type="button"> <?php echo app('translator')->get('Buy Now'); ?> </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php if($totalPackage > $packages->count()): ?>
            <div class="mt-5 text-center">
                <a class="btn btn--base" href="<?php echo e(route('packages')); ?>"><?php echo app('translator')->get('See More'); ?></a>
            </div>
        <?php endif; ?>
    </div>
</div>

<div id="boostModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo app('translator')->get('Confirmation Alert!'); ?></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form action="<?php echo e(route('user.payment.buy.package')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <p><?php echo app('translator')->get('Are you sure to purchase this package?'); ?></p>
                </div>
                <input type="hidden" name="package_id">
                <input type="hidden" name="coupon_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark btn-sm" data-bs-dismiss="modal"><?php echo app('translator')->get('No'); ?></button>
                    <button type="submit" class="btn btn--base btn-sm"><?php echo app('translator')->get('Yes'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>






































































<?php $__env->startPush('style'); ?>
    <style>
        .modal .btn {
            padding: 5px 10px !important;
        }

        .modal-title {
            margin: 0;
        }

        .modal-header {
            padding: 13px 15px;
        }

        .modal-body h6 {
            margin: 1rem 1rem;
        }

        .list-group-item {
            color: unset;
            font-size: 14px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function ($) {
            "use strict";
            $(document).on('click','.boostBtn', function () {
                var modal   = $('#boostModal');
                let data    = $(this).data();
                modal.find('[name=package_id]').val(data.package_id);
                modal.modal('show');
            });
        })(jQuery);
        
        

        
        
        
        

        
        
        

        
        

        
        
        
        
        
        

        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        

        
        
        

        
        

        
        
        
        
        
        
        
        

        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        (function ($) {
            "use strict";

            $('.packageBtn').on('click', function () {
                let packageId = $(this).data('package').id;
                let url = `<?php echo e(route('user.payment.buy.package', ':id')); ?>`;
                url = url.replace(':id', packageId);
                window.location.href = url;
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/partials/package.blade.php ENDPATH**/ ?>