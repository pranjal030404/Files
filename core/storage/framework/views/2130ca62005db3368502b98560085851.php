<?php
    $sidenav = json_decode($sidenav);

    $settings = file_get_contents(resource_path('views/admin/setting/settings.json'));
    $settings = json_decode($settings);

    $routesData = [];
    foreach (\Illuminate\Support\Facades\Route::getRoutes() as $route) {
        $name = $route->getName();
        if (strpos($name, 'admin') !== false) {
            $routeData = [
                $name => url($route->uri()),
            ];

            $routesData[] = $routeData;
        }
    }
?>

<!-- navbar-wrapper start -->
<nav class="navbar-wrapper bg--dark d-flex flex-wrap">
    <div class="navbar__left">
        <button type="button" class="res-sidebar-open-btn me-3"><i class="las la-bars"></i></button>
        <form class="navbar-search">
            <input type="search" name="#0" class="navbar-search-field" id="searchInput" autocomplete="off"
                placeholder="<?php echo app('translator')->get('Search here...'); ?>">
            <i class="las la-search"></i>
            <ul class="search-list"></ul>
        </form>
    </div>
    <div class="navbar__right">
        <ul class="navbar__action-list">
            <?php if(version_compare(gs('available_version'),systemDetails()['version'],'>')): ?>
            <li><button type="button" class="primary--layer" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo app('translator')->get('Update Available'); ?>"><a href="<?php echo e(route('admin.system.update')); ?>" class="primary--layer"><i class="las la-download text--warning"></i></a> </button></li>
            <?php endif; ?>
            <li>
                <button type="button" class="primary--layer" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo app('translator')->get('Visit Website'); ?>">
                    <a href="<?php echo e(route('home')); ?>" target="_blank"><i class="las la-globe"></i></a>
                </button>
            </li>
            <li class="dropdown">
                <button type="button" class="primary--layer notification-bell" data-bs-toggle="dropdown" data-display="static"
                    aria-haspopup="true" aria-expanded="false">
                    <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo app('translator')->get('Unread Notifications'); ?>">
                        <i class="las la-bell <?php if($adminNotificationCount > 0): ?> icon-left-right <?php endif; ?>"></i>
                    </span>
                    <?php if($adminNotificationCount > 0): ?>
                    <span class="notification-count"><?php echo e($adminNotificationCount <= 9 ? $adminNotificationCount : '9+'); ?></span>
                    <?php endif; ?>
                </button>
                <div class="dropdown-menu dropdown-menu--md p-0 border-0 box--shadow1 dropdown-menu-right">
                    <div class="dropdown-menu__header">
                        <span class="caption"><?php echo app('translator')->get('Notification'); ?></span>
                        <?php if($adminNotificationCount > 0): ?>
                            <p><?php echo app('translator')->get('You have'); ?> <?php echo e($adminNotificationCount); ?> <?php echo app('translator')->get('unread notification'); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="dropdown-menu__body <?php if(blank($adminNotifications)): ?> d-flex justify-content-center align-items-center <?php endif; ?>">
                        <?php $__empty_1 = true; $__currentLoopData = $adminNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a href="<?php echo e(route('admin.notification.read',$notification->id)); ?>"
                                class="dropdown-menu__item">
                                <div class="navbar-notifi">
                                    <div class="navbar-notifi__right">
                                        <h6 class="notifi__title"><?php echo e(__($notification->title)); ?></h6>
                                        <span class="time"><i class="far fa-clock"></i>
                                            <?php echo e(diffForHumans($notification->created_at)); ?></span>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="empty-notification text-center">
                            <img src="<?php echo e(getImage('assets/images/empty_list.png')); ?>" alt="empty">
                            <p class="mt-3"><?php echo app('translator')->get('No unread notification found'); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="dropdown-menu__footer">
                        <a href="<?php echo e(route('admin.notifications')); ?>"
                            class="view-all-message"><?php echo app('translator')->get('View all notifications'); ?></a>
                    </div>
                </div>
            </li>
            <li>
                <button type="button" class="primary--layer" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo app('translator')->get('System Setting'); ?>">
                    <a href="<?php echo e(route('admin.setting.system')); ?>"><i class="las la-wrench"></i></a>
                </button>
            </li>
            <li class="dropdown d-flex profile-dropdown">
                <button type="button" data-bs-toggle="dropdown" data-display="static" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="navbar-user">
                        <span class="navbar-user__thumb"><img src="<?php echo e(getImage(getFilePath('adminProfile').'/'. auth()->guard('admin')->user()->image,getFileSize('adminProfile'))); ?>" alt="image"></span>
                        <span class="navbar-user__info">
                            <span class="navbar-user__name"><?php echo e(auth()->guard('admin')->user()->username); ?></span>
                        </span>
                        <span class="icon"><i class="las la-chevron-circle-down"></i></span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu--sm p-0 border-0 box--shadow1 dropdown-menu-right">
                    <a href="<?php echo e(route('admin.profile')); ?>"
                        class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-user-circle"></i>
                        <span class="dropdown-menu__caption"><?php echo app('translator')->get('Profile'); ?></span>
                    </a>

                    <a href="<?php echo e(route('admin.password')); ?>"
                        class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-key"></i>
                        <span class="dropdown-menu__caption"><?php echo app('translator')->get('Password'); ?></span>
                    </a>

                    <a href="<?php echo e(route('admin.logout')); ?>" class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-sign-out-alt"></i>
                        <span class="dropdown-menu__caption"><?php echo app('translator')->get('Logout'); ?></span>
                    </a>
                </div>
                <button type="button" class="breadcrumb-nav-open ms-2 d-none">
                    <i class="las la-sliders-h"></i>
                </button>
            </li>
        </ul>
    </div>
</nav>
<!-- navbar-wrapper end -->

<?php $__env->startPush('script'); ?>
<script>
    "use strict";
    var routes = <?php echo json_encode($routesData) ?>;
    var settings = <?php echo json_encode($settings) ?>;
    var sidenav = <?php echo json_encode($sidenav) ?>;
    var settingsData = Object.assign({}, settings , sidenav);

    $('.navbar__action-list .dropdown-menu').on('click', function(event){
        event.stopPropagation();
    });
</script>
<script src="<?php echo e(asset('assets/admin/js/search.js')); ?>"></script>
<script>
    "use strict";
    function getEmptyMessage(){
        return `<li class="text-muted">
                <div class="empty-search text-center">
                    <img src="<?php echo e(getImage('assets/images/empty_list.png')); ?>" alt="empty">
                    <p class="text-muted">No search result found</p>
                </div>
            </li>`
    }
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/admin/partials/topnav.blade.php ENDPATH**/ ?>