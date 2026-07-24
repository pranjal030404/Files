<?php if(gs('multi_language')): ?>
    <?php
        $language = App\Models\Language::all();
        $selectedLanguage = null;
        if (session('lang')) {
            $selectedLanguage = $language->where('code', config('app.locale'))->first();
        }
    ?>
    <div class="language dropdown">
        <button class="language-wrapper" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="language-content">
                <div class="language_flag">
                    <img src="<?php echo e(getImage(getFilePath('language') . '/' . @$selectedLanguage->image, getFileSize('language'))); ?>" alt="image">
                </div>
                <p class="language_text_select"><?php echo e(__(@$selectedLanguage->name)); ?></p>
            </div>
            <span class="collapse-icon"><i class="las la-angle-down"></i></span>

        </button>

        <div class="dropdown-menu langList_dropdow py-2" style="">
            <ul class="langList">
                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="language-list">
                        <a href="<?php echo e(route('lang', $item->code)); ?>">
                            <div class="language_flag">
                                <img src="<?php echo e(getImage(getFilePath('language') . '/' . @$item->image, getFileSize('language'))); ?>" alt="image">
                            </div>
                        </a>
                        <a href="<?php echo e(route('lang', $item->code)); ?>">
                            <p class="language_text <?php if(session('lang') == $item->code): ?> custom--dropdown__selected <?php endif; ?>" ><?php echo e(__($item->name)); ?></p>
                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /home/pranjal/Pranjal/vscode/Files/core/resources/views/templates/basic/partials/language.blade.php ENDPATH**/ ?>