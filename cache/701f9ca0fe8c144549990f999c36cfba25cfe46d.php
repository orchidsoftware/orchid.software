<?php if(count($anchors) > 1): ?>
    <ul class="pl-5">
        <?php $__currentLoopData = $anchors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anchor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="anchor-<?php echo e($anchor['level']); ?>">
                <a href="#<?php echo e($anchor['id']); ?>"><?php echo e($anchor['text']); ?></a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <hr>
<?php endif; ?><?php /**PATH source/_layouts/anchors.blade.php ENDPATH**/ ?>