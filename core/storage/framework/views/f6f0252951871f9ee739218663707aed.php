<?php
    use App\Constants\Status;
    use App\Models\Language;
    $pages = App\Models\Page::where('tempname', activeTemplate())
        ->where('is_default', Status::NO)
        ->get();
?>

<!-- ==================== Bottom Header End Here ==================== -->
<header class="header-bottom">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand logo" href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(siteLogo('dark')); ?>" alt="site logo">
            </a>
            <button class="navbar-toggler header-button" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="las la-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-menu ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(menuActive('home')); ?>" href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(menuActive('packages')); ?>" href="<?php echo e(route('packages')); ?>"><?php echo app('translator')->get('Packages'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(menuActive('member.list')); ?>" href="<?php echo e(route('member.list')); ?>"><?php echo app('translator')->get('Members'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(menuActive('stories')); ?>" href="<?php echo e(route('stories')); ?>"><?php echo app('translator')->get('Stories'); ?></a>
                    </li>

                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->url() == route('pages', [$page->slug])): ?> active <?php endif; ?>" href="<?php echo e(url($page->slug)); ?>"><?php echo e(__($page->name)); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <li class="nav-item">
                        <a class="nav-link <?php echo e(menuActive('contact')); ?>" href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->get('Contact'); ?></a>
                    </li>

                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item d-lg-none d-block">
                            <a class="nav-link <?php echo e(menuActive('user.home')); ?>" href="<?php echo e(route('user.login')); ?>">
                                <?php echo app('translator')->get('Dashboard'); ?></a>
                        </li>
                        <li class="nav-item d-lg-none d-block d-flex justify-content-between">
                            <a class="nav-link" href="<?php echo e(route('user.logout')); ?>"> <?php echo app('translator')->get('Logout'); ?></a>
                            <?php if(gs('multi_language')): ?>
                                <select class="langSel select language-select">
                                    <?php
                                        $language = Language::all();
                                    ?>
                                    <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($lang->code); ?>" <?php if(session()->get('lang') == $lang->code): echo 'selected'; endif; ?>><?php echo app('translator')->get($lang->name); ?>
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <?php endif; ?>
                        </li>
                    <?php else: ?>
                        <li class="nav-item d-lg-none d-block">
                            <a class="nav-link <?php echo e(menuActive('user.login')); ?>" href="<?php echo e(route('user.login')); ?>">
                                <?php echo app('translator')->get('Login'); ?></a>
                        </li>
                        <li class="nav-item d-lg-none d-block d-flex justify-content-between">
                            <a class="nav-link <?php echo e(menuActive('user.register')); ?>" href="<?php echo e(route('user.register')); ?>">
                                <?php echo app('translator')->get('Register'); ?> </a>
                            <?php if(gs('multi_language')): ?>
                                <select class="langSel select language-select">
                                    <?php
                                        $language = Language::all();
                                    ?>
                                    <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($lang->code); ?>" <?php if(session()->get('lang') == $lang->code): echo 'selected'; endif; ?>><?php echo app('translator')->get($lang->name); ?>
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <?php endif; ?>
                        </li>

                    <?php endif; ?>
                </ul>
                <div class="d-none d-lg-block">
                    <ul class="header-login list primary-menu">
                        <?php echo $__env->make('Template::partials.language', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php if(auth()->guard()->check()): ?>
                            <li class="header-login__item">
                                <a class="btn btn--base btn--sm" href="<?php echo e(route('user.home')); ?>"> <i class="las la-user"></i> <?php echo app('translator')->get('Dashboard'); ?></a>
                            </li>

                            <li class="header-login__item">
                                <a class="btn btn--base btn--sm btn--outline" href="<?php echo e(route('user.logout')); ?>">
                                    <?php echo app('translator')->get('Logout'); ?> </a>
                            </li>
                        <?php else: ?>
                            <li class="header-login__item">
                                <a class="btn btn--base btn--sm" href="<?php echo e(route('user.login')); ?>"> <i class="las la-user"></i> <?php echo app('translator')->get('Login'); ?></a>
                            </li>

                            <?php if(gs('registration')): ?>
                                <li class="header-login__item">
                                    <a class="btn btn--base btn--sm btn--outline" href="<?php echo e(route('user.register')); ?>">
                                        <?php echo app('translator')->get('Register'); ?> </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <!-- User Login End -->
            </div>
        </nav>
    </div>
</header>
<!-- ==================== Bottom Header End Here ==================== -->

<!-- =========================== Mobile Device Bottom Navigation Start ============================ -->
<div class="mobile-nav d-lg-none d-block">
    <div class="container">
        <ul class="mobile-nav__menu d-flex justify-content-between">
            <li class="mobile-nav__item">
                <a class="mobile-nav__link text-decoration-none" href="<?php echo e(route('home')); ?>">
                    <i class="las la-home"></i>
                    <span><?php echo app('translator')->get('Home'); ?></span>
                </a>
            </li>

            <li class="mobile-nav__item">
                <a class="mobile-nav__link" href="<?php echo e(route('member.list')); ?>">
                    <i class="las la-users"></i>
                    <span><?php echo app('translator')->get('Members'); ?></span>
                </a>
            </li>

            <li class="mobile-nav__item">
                <a class="mobile-nav__link" href="<?php echo e(route('contact')); ?>">
                    <i class="las la-comment-dots"></i>
                    <span><?php echo app('translator')->get('Contact'); ?></span>
                </a>
            </li>
            <li class="mobile-nav__item">
                <a class="mobile-nav__link" href="<?php echo e(route('user.login')); ?>">
                    <span>
                        <?php if(auth()->guard()->check()): ?>
                            <i class="las la-tachometer-alt"></i>
                            <?php echo app('translator')->get('Dashboard'); ?>
                        <?php else: ?>
                            <i class="las la-user"></i>
                            <?php echo app('translator')->get('Account'); ?>
                        <?php endif; ?>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>

<?php $__env->startPush('script'); ?>
    <script>
        $(document).ready(function() {
            const $mainlangList = $(".langList");
            const $langBtn = $(".language-content");
            const $langListItem = $mainlangList.children();

            $langListItem.each(function() {
                const $innerItem = $(this);
                const $languageText = $innerItem.find(".language_text");
                const $languageFlag = $innerItem.find(".language_flag");

                $innerItem.on("click", function(e) {
                    $langBtn.find(".language_text_select").text($languageText.text());
                    $langBtn.find(".language_flag").html($languageFlag.html());
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/partials/header.blade.php ENDPATH**/ ?>