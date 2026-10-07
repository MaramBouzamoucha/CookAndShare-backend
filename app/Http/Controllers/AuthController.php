<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ===== API existantes =====

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        return response()->json([
            "success" => true,
            "message" => "Inscription réussie",
            "user" => $user
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json([
                'message' => 'Connecté',
                'user' => Auth::user()
            ]);
        }

        return response()->json(['message' => 'Identifiants incorrects'], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Déconnecté']);
    }

    public function me(Request $request)
    {
        return response()->json(Auth::user());
    }

    // ===== Méthodes Blade =====

    public function showRegisterForm() {
        return view('auth.register');
    }

    public function showLoginForm() {
        return view('auth.login');
    }

    public function showProfile() {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    // Méthode pour traiter le login depuis Blade
    public function loginBlade(Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('recipes.indexBlade')->with('success', 'Connecté avec succès !');
        }
        return back()->withErrors(['email' => 'Identifiants incorrects'])->withInput();
    }

    // Méthode pour traiter l'inscription depuis Blade
    public function registerBlade(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('recipes.indexBlade')->with('success', 'Inscription réussie !');
    }

    // Méthode pour logout depuis Blade
    public function logoutBlade(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginForm')->with('success', 'Déconnecté avec succès !');
    }
}
