<?php

namespace App\Http\Controllers;

use App\Models\Mype;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Mostrar formulario de inicio de sesión
    public function showLogin()
    {
        return view('auth.login');
    }

    // Mostrar formulario de registro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Registrar una empresa y su administrador
    public function register(Request $request)
    {
        $data = $request->validate([
            'business_name' => 'required|string|max:150',
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = DB::transaction(function () use ($data) {
            $mype = Mype::create([
                'name' => $data['business_name'],
                'slug' => Str::slug($data['business_name'])
                    . '-' . Str::lower(Str::random(8)),
                'active' => true,
            ]);

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'mype_admin',
                'mype_id' => $mype->id,
            ]);
        });

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    // Iniciar sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'Correo o contraseña incorrectos.',
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'mype_admin' &&
            (!$user->mype || !$user->mype->active)) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => 'La empresa está desactivada.',
            ]);
        }

        return redirect()->intended(route('dashboard'));
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
