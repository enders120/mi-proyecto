<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'CloudBiz MYPES')</title>
@vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="cb-body">
@auth
<div x-data="{open:false,collapsed:false}" class="cb-shell">
<div x-show="open" x-cloak @click="open=false" class="cb-overlay"></div>
<aside :class="[open?'is-open':'',collapsed?'is-collapsed':'']" class="cb-sidebar">
    <a href="{{ route('dashboard') }}" class="cb-brand"><span class="cb-brand-icon">✦</span><span class="cb-brand-text"><strong>CloudBiz</strong><small>MYPES PERÚ</small></span></a>
    <div class="cb-company">
      <div class="cb-company-logo">@if(auth()->user()->mype?->logo)<img src="{{ asset('storage/'.auth()->user()->mype->logo) }}" alt="Logo de la empresa">@else<span>🏪</span>@endif</div>
      <div class="cb-company-copy"><strong>{{ auth()->user()->mype?->name ?? 'Mi negocio' }}</strong><small>Panel empresarial</small></div>
    </div>
    <nav class="cb-nav" aria-label="Menú principal">
      <a href="{{route('dashboard')}}" class="{{request()->routeIs('dashboard')?'active':''}}"><span>▦</span><span class="cb-nav-label">Dashboard</span></a>
      <a href="{{route('products.index')}}" class="{{request()->routeIs('products.*')?'active':''}}"><span>▣</span><span class="cb-nav-label">Productos</span></a>
      <a href="{{route('categories.index')}}" class="{{request()->routeIs('categories.*')?'active':''}}"><span>◇</span><span class="cb-nav-label">Categorías</span></a>
      <a href="{{route('customers.index')}}" class="{{request()->routeIs('customers.*')?'active':''}}"><span>♙</span><span class="cb-nav-label">Clientes</span></a>
      <a href="{{route('orders.index')}}" class="{{request()->routeIs('orders.*')?'active':''}}"><span>▤</span><span class="cb-nav-label">Pedidos</span></a>
      @if(auth()->user()->mype)<a href="{{route('shop.show',auth()->user()->mype->slug)}}" target="_blank" rel="noopener"><span>↗</span><span class="cb-nav-label">Ver mi tienda</span></a>@endif
    </nav>
    <div class="cb-sidebar-bottom">
      <p class="cb-user-name">{{auth()->user()->name}}</p>
      <form method="POST" action="{{route('logout')}}">@csrf<button type="submit" class="cb-logout">Cerrar sesión</button></form>
    </div>
</aside>
<div class="cb-workspace">
<header class="cb-topbar"><div class="cb-top-left"><button type="button" class="cb-menu-toggle" @click="if(window.innerWidth>=1024){collapsed=!collapsed}else{open=!open}" aria-label="Abrir o cerrar menú">☰</button><div><strong>Panel de administración</strong><small>Gestiona tu negocio desde un solo lugar</small></div></div><div class="cb-top-user"><span class="cb-user-dot">●</span>{{auth()->user()->name}}</div></header>
<main class="cb-main">
@if(session('success'))<div class="cb-alert cb-alert-success">{{session('success')}}</div>@endif
@if($errors->has('logo'))<div class="cb-alert cb-alert-error">{{$errors->first('logo')}}</div>@endif
@yield('content')
@if(auth()->user()->mype)
<section class="cb-brand-settings"><div><p class="cb-eyebrow">PERSONALIZACIÓN</p><h2>Identidad de tu empresa</h2><p>Sube tu logotipo para mostrarlo en el menú lateral y en tu tienda pública. JPG, PNG o WEBP, máximo 2 MB.</p></div><form action="{{route('business.logo.update')}}" method="POST" enctype="multipart/form-data" class="cb-logo-form">@csrf<input type="file" name="logo" accept="image/png,image/jpeg,image/webp" required aria-label="Seleccionar logo"><button type="submit">Guardar logotipo</button></form></section>
@endif
</main>
</div>
</div>
@else<main>@yield('content')</main>@endauth
</body></html>
