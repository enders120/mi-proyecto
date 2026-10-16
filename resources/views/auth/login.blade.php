
@extends('layouts.app')

@section('title', 'Iniciar sesión - CloudBiz')

@section('content')
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

        @if ($errors->any())
            <div class="bg-red-50 text-red-700 p-3
                        rounded-lg mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST"
              action="{{ route('login.submit') }}"
              class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-2">
                    Correo electrónico
                </label>

                <input type="email" name="email"
                       value="{{ old('email') }}"
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
            <a href="{{ route('register') }}"
               class="text-emerald-700 font-semibold">
                Registrar negocio
            </a>
        </p>
    </div>
</div>
@endsection
