<?php
    $bannerContent = getContent('banner.content', true);
    $bannerElement = getContent('banner.element', limit: 5);

    $countryData = (array) json_decode(file_get_contents(resource_path('views/partials/country.json')));
    $countries = array_column($countryData, 'country');
    $maritalStatuses = App\Models\MaritalStatus::all();
?>

<!-- Hero  -->
<section class="hero">
    <div class="hero-slider">
        <?php $__currentLoopData = $bannerElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="hero-slider__item">
                <img src="<?php echo e(frontendImage('banner', $banner->data_values->slider_image, '1920x1080')); ?>" alt="<?php echo app('translator')->get('Banner'); ?>">
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="hero__content">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-xl-7 col-lg-6 pe-xl-5">
                    <h4 class="hero__content-subtitle text-dark mt-0">
                        <span><?php echo app('translator')->get('Welcome'); ?></span> <?php echo e(__('To ' . gs('site_name'))); ?>

                    </h4>
                    <h1 class="hero__content-title text-capitalize">
                        <?php echo e(__(@$bannerContent->data_values->subheading)); ?>

                    </h1>
                    <div class="mx-auto">
                        <a class="btn btn--base mt-3" href="<?php echo e(url(@$bannerContent->data_values->button_url)); ?>">
                            <?php echo e(__(@$bannerContent->data_values->button_text)); ?>

                        </a>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="banner-account">
                        <form class="register-form" action="<?php echo e(route('member.list')); ?>">
                            <div class="section__head pb-3 text-center">
                                <h2 class="login-title mt-0"><?php echo app('translator')->get('Find Your Partner'); ?></h2>
                            </div>
                            <div class="row gy-4">
                                <div class="col-lg-12">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="country">
                                            <option value=""><?php echo app('translator')->get('Select One'); ?></option>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($country); ?>"><?php echo e(__($country)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <label class="form--label"><?php echo app('translator')->get('Country'); ?></label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" id="city" name="city" type="text">
                                        <label class="form--label" for="city"><?php echo app('translator')->get('City'); ?></label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input--group">
                                        <input class="form-control form--control" id="profession" name="profession" type="text">
                                        <label class="form--label" for="profession"><?php echo app('translator')->get('Profession'); ?></label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="marital_status">
                                            <option value=""><?php echo app('translator')->get('Select One'); ?></option>
                                            <?php $__currentLoopData = $maritalStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $maritalStatus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($maritalStatus->title); ?>"><?php echo e(__($maritalStatus->title)); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <label class="form--label"><?php echo app('translator')->get('Marital Status'); ?></label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="looking_for">
                                            <option value=""><?php echo app('translator')->get('Select One'); ?></option>
                                            <option value="1"><?php echo app('translator')->get('Bridegroom'); ?></option>
                                            <option value="2"><?php echo app('translator')->get('Bride'); ?></option>
                                        </select>
                                        <label class="form--label"><?php echo app('translator')->get('Looking For'); ?></label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="smoking_status">
                                            <option value=""><?php echo app('translator')->get('Select One'); ?></option>
                                            <option value="1"><?php echo app('translator')->get('Smoker'); ?></option>
                                            <option value="0"><?php echo app('translator')->get('Non-smoker'); ?></option>
                                        </select>
                                        <label class="form--label"><?php echo app('translator')->get('Smoking Habits'); ?></label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input--group">
                                        <select class="form-select form-control form--control" name="drinking_status">
                                            <option value=""><?php echo app('translator')->get('Select One'); ?></option>
                                            <option value="1"><?php echo app('translator')->get('Drunker'); ?></option>
                                            <option value="0"><?php echo app('translator')->get('Non-drunker'); ?></option>
                                        </select>
                                        <label class="form--label"><?php echo app('translator')->get('Drinking Status'); ?></label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn--base w-100" type="submit"><?php echo app('translator')->get('Search'); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/sections/banner.blade.php ENDPATH**/ ?>