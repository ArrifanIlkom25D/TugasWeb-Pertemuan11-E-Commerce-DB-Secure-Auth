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
     <?php $__env->slot('header', null, []); ?> <h2 class="font-semibold text-xl">Daftar Produk</h2> <?php $__env->endSlot(); ?>

    <div class="py-6 max-w-6xl mx-auto sm:px-6 lg:px-8">
        <?php if(session('status')): ?> <div class="mb-4 p-3 bg-green-100 rounded"><?php echo e(session('status')); ?></div> <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Product::class)): ?>
            <a href="<?php echo e(route('products.create')); ?>" class="inline-block mb-4 px-4 py-2 bg-indigo-600 text-white rounded">+ Produk</a>
        <?php endif; ?>

        <table class="w-full bg-white shadow rounded text-sm">
            <thead><tr class="text-left border-b">
                <th class="p-3">Nama</th><th>Kategori</th><th>Brand</th><th>Harga</th><th>Stok</th><th>Aksi</th>
            </tr></thead>
            <tbody>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b">
                    <td class="p-3"><?php echo e($p->name); ?></td>
                    <td><?php echo e($p->category->name); ?></td>
                    <td><?php echo e($p->brand->name); ?></td>
                    <td>Rp <?php echo e(number_format($p->price, 0, ',', '.')); ?></td>
                    <td><?php echo e($p->stock); ?></td>
                    <td class="flex gap-2 py-2">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $p)): ?>
                            <a href="<?php echo e(route('products.edit', $p)); ?>" class="text-indigo-600">Edit</a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $p)): ?>
                            <form method="POST" action="<?php echo e(route('products.destroy', $p)); ?>" onsubmit="return confirm('Hapus?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="text-red-600">Hapus</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="mt-4"><?php echo e($products->links()); ?></div>
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
<?php endif; ?>
<?php /**PATH D:\File Tugas Pemograman Web\Tugas 11\resources\views/products/index.blade.php ENDPATH**/ ?>