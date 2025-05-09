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



    <div class="container mx-auto mt-2">
        <h1 class="alert alert-info w-15">Listado de Citas</h1>
        <?php if(session('success')): ?>
        <div class="alert alert-success mx-auto  ">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="alert alert-danger  ">
            <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>
        <!-- solo el taller puede filtrar -->
        <?php if(auth()->user()->role === 'taller'): ?>


        <form method="GET" action="<?php echo e(route('citas.filtrar')); ?>">
            <label for="estado">Estado:</label>
            <select name="estado" id="estado" onchange="this.form.submit()">
                <option value=""> Todas </option>
                <option value="sincita" <?php echo e(request('estado') == 'sincita' ? 'selected' : ''); ?>>Sin cita</option>
                <option value="concita" <?php echo e(request('estado') == 'concita' ? 'selected' : ''); ?>>Con cita</option>
            </select>
        </form>
        <?php endif; ?>
        <table class="table table-bordered  table-hover mt-2 ">
            <thead class="">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Modelo</th>
                    <th>Matricula</th>
                    <th>fecha</th>
                    <th>Hora</th>
                    <th>duracion</th>

                    <?php if(auth()->user()->role === 'taller'): ?>
                    <th>Acciones</th>
                    <?php endif; ?>

            </thead>
            <tbody>

                <?php if($citas->isEmpty()): ?>
                <tr>
                    <td class="text-center" colspan="8">No hay citas</td>
                </tr>
                <?php else: ?>
                <?php $__currentLoopData = $citas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($cita->id); ?></td>
                    <td><?php echo e($cita->user->name); ?></td>
                    <td><?php echo e($cita->modelo); ?></td>
                    <td><?php echo e($cita->matricula); ?></td>


                    <td><?php echo e($cita->fecha); ?></td>
                    <td><?php echo e($cita->hora); ?></td>
                    <td><?php echo e($cita->duracion); ?></td>

                    <?php if(auth()->user()->role === 'taller'): ?>
                    <td>
                        <a href="<?php echo e(route('citas.modificar-cita', $cita->id)); ?>" class="btn btn-sm btn-outline-success"
                            title="Editar">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger"
                            data-bs-toggle="modal" data-bs-target="#modalEliminarCita<?php echo e($cita->id); ?>"
                            title="Eliminar">
                            <i class="bi bi-trash3"></i>
                        </button>

                        <!-- modal eliminar -->
                        <div class="modal fade" id="modalEliminarCita<?php echo e($cita->id); ?>" tabindex="-1" aria-labelledby="modalEliminarLabel<?php echo e($cita->id); ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content border-danger">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger" id="modalEliminarLabel<?php echo e($cita->id); ?>">Confirmar eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estas seguro de que quieres eliminar la cita ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                                        
                                        <form action="<?php echo e(route('citas.eliminar-cita', $cita->id)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>

        </table>
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
<?php endif; ?><?php /**PATH /var/www/html/resources/views/citas/show.blade.php ENDPATH**/ ?>