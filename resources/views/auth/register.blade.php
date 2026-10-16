
@extends('layouts.app')

@section('title', 'Registrar empresa - CloudBiz')

@section('content')
<div class="min-h-screen flex justify-center
            items-center p-5">

    <div class="bg-white max-w-lg w-full
                rounded-2xl border shadow-sm p-8">

        <h1 class="text-2xl font-bold text-emerald-700">
            Registra tu negocio
        </h1>

        <p class="text-slate-500 mt-2 mb-6">
            Empieza a gestionar tu MYPE con CloudBiz.
        </p>

        @if ($errors->any())
            <div class="bg-red-50 text-red-700 p-3
                        rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ route('register.submit') }}"
              class="space-y-4">
            @csrf

            <div>
                <label>Nombre del negocio</label>
                <input name="business_name"
                       value="{{ old('business_name') }}"
                       required maxlength="150"
                       class="w-full border rounded-lg p-3 mt-1">
            </div>

            <div>
                <label>Nombre del administrador</label>
                <input name="name"
                       value="{{ old('name') }}"
                       required maxlength="150"
                       class="w-full border rounded-lg p-3 mt-1">
            </div>

            <div>
                <label>Correo electrónico</label>
                <input type="email" name="email"
                       value="{{ old('email') }}"
                       required autocomplete="email"
                       class="w-full border rounded-lg p-3 mt-1">
            </div>

            <div>
                <label>Contraseña</label>
                <input type="password" name="password"
                       required minlength="8"
                       autocomplete="new-password"
                       class="w-full border rounded-lg p-3 mt-1">
            </div>

            <div>
                <label>Confirmar contraseña</label>
                <input type="password"
                       name="password_confirmation"
                       required minlength="8"
                       autocomplete="new-password"
                       class="w-full border rounded-lg p-3 mt-1">
            </div>

            <button type="submit"
                    class="w-full bg-emerald-700 text-white
                           p-3 rounded-lg font-semibold">
                Crear mi cuenta
            </button>
        </form>

        <p class="text-center mt-5 text-sm">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}"
               class="text-emerald-700 font-semibold">
                Iniciar sesión
            </a>
        </p>
    </div>
</div>
@endsection
