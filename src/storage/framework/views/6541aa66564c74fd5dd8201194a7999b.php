<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <?php echo e(__('Usuarios')); ?>

            </h2>
            <a href="<?php echo e(route('users.create')); ?>" class="btn btn-outline-primary px-2 py-1 rounded-md">
                <?php echo e(__('Nuevo usuario')); ?>

            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                    <?php endif; ?>

                    <div class="overflow-x-auto">
                        <table class="table-fixed w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2 w-1/3"><?php echo e(__('Nombre')); ?></th>
                                    <th class="border border-gray-300 px-4 py-2 w-1/3"><?php echo e(__('Email')); ?></th>
                                    <th class="border border-gray-300 px-4 py-2 w-1/6"><?php echo e(__('Rol')); ?></th>
                                    <th class="border border-gray-300 px-4 py-2 w-1/6 text-center"><?php echo e(__('')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2 w-1/3 truncate whitespace-nowrap"><?php echo e($user->name); ?></td>
                                        <td class="border border-gray-300 px-4 py-2 w-1/3 truncate whitespace-nowrap"><a href="mailto:<?php echo e($user->email); ?>"><?php echo e($user->email); ?></a></td>
                                        <td class="border border-gray-300 px-4 py-2 w-1/6 capitalize"><?php echo e($roles[$user->role]); ?></td>
                                        <td class="border border-gray-300 px-4 py-2 w-1/6 text-center">
                                            <div class="flex justify-center items-center gap-1">
                                                <a href="<?php echo e(route('users.show', $user)); ?>" class="btn btn-sm btn-outline-primary" title="<?php echo e(__('Ver')); ?>">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>

                                                <a href="<?php echo e(route('users.edit', $user)); ?>" class="btn btn-sm btn-outline-success" title="<?php echo e(__('Editar')); ?>">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>

                                                <form action="<?php echo e(route('users.destroy', $user)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                            title="<?php echo e(__('Eliminar')); ?>"
                                                            onclick="return confirm('<?php echo e(__('¿Estás seguro?')); ?>')">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /var/www/html/resources/views/users/index.blade.php ENDPATH**/ ?>