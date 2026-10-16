<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $__env->yieldContent('title', 'CloudBiz MYPES'); ?></title>
<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>
</head>
<body class="cb-body">
<?php if(auth()->guard()->check()): ?>
<div x-data="{open:false,collapsed:false}" class="cb-shell">
<div x-show="open" x-cloak @click="open=false" class="cb-overlay"></div>
<aside :class="[open?'is-open':'',collapsed?'is-collapsed':'']" class="cb-sidebar">
    <a href="<?php echo e(route('dashboard')); ?>" class="cb-brand"><span class="cb-brand-icon">✦</span><span class="cb-brand-text"><strong>CloudBiz</strong><small>MYPES PERÚ</small></span></a>
    <div class="cb-company">
      <div class="cb-company-logo"><?php if(auth()->user()->mype?->logo): ?><img src="<?php echo e(asset('storage/'.auth()->user()->mype->logo)); ?>" alt="Logo de la empresa"><?php else: ?><span>🏪</span><?php endif; ?></div>
      <div class="cb-company-copy"><strong><?php echo e(auth()->user()->mype?->name ?? 'Mi negocio'); ?></strong><small>Panel empresarial</small></div>
    </div>
    <nav class="cb-nav" aria-label="Menú principal">
      <a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(request()->routeIs('dashboard')?'active':''); ?>"><span>▦</span><span class="cb-nav-label">Dashboard</span></a>
      <a href="<?php echo e(route('products.index')); ?>" class="<?php echo e(request()->routeIs('products.*')?'active':''); ?>"><span>▣</span><span class="cb-nav-label">Productos</span></a>
      <a href="<?php echo e(route('categories.index')); ?>" class="<?php echo e(request()->routeIs('categories.*')?'active':''); ?>"><span>◇</span><span class="cb-nav-label">Categorías</span></a>
      <a href="<?php echo e(route('customers.index')); ?>" class="<?php echo e(request()->routeIs('customers.*')?'active':''); ?>"><span>♙</span><span class="cb-nav-label">Clientes</span></a>
      <a href="<?php echo e(route('orders.index')); ?>" class="<?php echo e(request()->routeIs('orders.*')?'active':''); ?>"><span>▤</span><span class="cb-nav-label">Pedidos</span></a>
      <?php if(auth()->user()->mype): ?><a href="<?php echo e(route('shop.show',auth()->user()->mype->slug)); ?>" target="_blank" rel="noopener"><span>↗</span><span class="cb-nav-label">Ver mi tienda</span></a><?php endif; ?>
    </nav>
    <div class="cb-sidebar-bottom">
      <p class="cb-user-name"><?php echo e(auth()->user()->name); ?></p>
      <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?><button type="submit" class="cb-logout">Cerrar sesión</button></form>
    </div>
</aside>
<div class="cb-workspace">
<header class="cb-topbar"><div class="cb-top-left"><button type="button" class="cb-menu-toggle" @click="if(window.innerWidth>=1024){collapsed=!collapsed}else{open=!open}" aria-label="Abrir o cerrar menú">☰</button><div><strong>Panel de administración</strong><small>Gestiona tu negocio desde un solo lugar</small></div></div><div class="cb-top-user"><span class="cb-user-dot">●</span><?php echo e(auth()->user()->name); ?></div></header>
<main class="cb-main">
<?php if(session('success')): ?><div class="cb-alert cb-alert-success"><?php echo e(session('success')); ?></div><?php endif; ?>
<?php if($errors->has('logo')): ?><div class="cb-alert cb-alert-error"><?php echo e($errors->first('logo')); ?></div><?php endif; ?>
<?php echo $__env->yieldContent('content'); ?>
<?php if(auth()->user()->mype): ?>
<section class="cb-brand-settings"><div><p class="cb-eyebrow">PERSONALIZACIÓN</p><h2>Identidad de tu empresa</h2><p>Sube tu logotipo para mostrarlo en el menú lateral y en tu tienda pública. JPG, PNG o WEBP, máximo 2 MB.</p></div><form action="<?php echo e(route('business.logo.update')); ?>" method="POST" enctype="multipart/form-data" class="cb-logo-form"><?php echo csrf_field(); ?><input type="file" name="logo" accept="image/png,image/jpeg,image/webp" required aria-label="Seleccionar logo"><button type="submit">Guardar logotipo</button></form></section>
<?php endif; ?>
</main>
</div>
</div>
<?php else: ?><main><?php echo $__env->yieldContent('content'); ?></main><?php endif; ?>
</body></html>
<?php /**PATH C:\Users\User\Documents\CloudBiz_Prueba\CloudBiz_MYPES_CORREGIDO_CPANEL\cloudbiz\resources\views/layouts/app.blade.php ENDPATH**/ ?>