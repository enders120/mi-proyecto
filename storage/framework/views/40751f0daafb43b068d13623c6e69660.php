


<?php $__env->startSection('title', 'Iniciar sesión - CloudBiz'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex items-center
            justify-center p-5">

    <div class="bg-white w-full max-w-md p-8
                rounded-2xl shadow-sm border">

        <h1 class="text-3xl font-bold text-emerald-700
                   text-center">
            CloudBiz
        </h1>

        <p class="text-center text-slate-500 mt-2 mb-8">
            Ingresa al panel de tu negocio
        </p>

        <?php if($errors->any()): ?>
            <div class="bg-red-50 text-red-700 p-3
                        rounded-lg mb-4">
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?>

        <form method="POST"
              action="<?php echo e(route('login.submit')); ?>"
              class="space-y-5">
            <?php echo csrf_field(); ?>

            <div>
                <label class="block text-sm font-medium mb-2">
                    Correo electrónico
                </label>

                <input type="email" name="email"
                       value="<?php echo e(old('email')); ?>"
                       required autocomplete="email"
                       class="w-full border border-slate-300
                              rounded-lg p-3">
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">
                    Contraseña
                </label>

                <input type="password" name="password"
                       required autocomplete="current-password"
                       class="w-full border border-slate-300
                              rounded-lg p-3">
            </div>

            <button type="submit"
                    class="w-full bg-emerald-700 text-white
                           p-3 rounded-lg font-semibold
                           hover:bg-emerald-800">
                Iniciar sesión
            </button>
        </form>

        <p class="text-center mt-6 text-sm">
            ¿No tienes cuenta?
            <a href="<?php echo e(route('register')); ?>"
               class="text-emerald-700 font-semibold">
                Registrar negocio
            </a>
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Documents\CloudBiz_Prueba\CloudBiz_MYPES_CORREGIDO_CPANEL\cloudbiz\resources\views/auth/login.blade.php ENDPATH**/ ?>