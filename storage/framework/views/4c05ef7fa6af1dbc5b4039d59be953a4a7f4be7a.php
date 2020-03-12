<?php $__env->startSection('sidebar'); ?>
<div class="quick-rules intype-jobs">
    <ul class="nav tr-list">

        <li class="nav-item <?php if(Route::currentRouteName() == 'user.postArticle'): ?> active <?php endif; ?>">
            <a class="nav-link" href="<?php echo e(route('user.postArticle')); ?>">
              <i class="material-icons">library_books</i>
              <p>Post Article</p>
            </a>
        </li>

        <li class="nav-item <?php if(Route::currentRouteName() == 'user.myAccount'): ?> active <?php endif; ?>">
            <a class="nav-link" href="<?php echo e(route('user.myAccount')); ?>">
              <i class="material-icons">library_books</i>
              <p>My Post</p>
            </a>
        </li>
    </ul>
</div>
<?php $__env->stopSection(); ?>