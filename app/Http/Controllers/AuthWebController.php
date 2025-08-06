<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class AuthWebController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            // Redirect sesuai role
            switch ($user->role) {
                case 'administrator':
                    return redirect('/admin/dashboard');
                case 'bankmini':
                    return redirect('/bankmini/dashboard');
                case 'toko':
                    return redirect('/toko/dashboard');
                case 'siswa':
                    return redirect('/siswa/dashboard');
                default:
                    return redirect('/');
            }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput();
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:administrator,bankmini,toko,siswa',
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'name' => $validated['name'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);
        $user->wallet()->create(['balance' => 0]);
        Auth::login($user);
        // Redirect sesuai role
        switch ($user->role) {
            case 'administrator':
                return redirect('/admin/dashboard');
            case 'bankmini':
                return redirect('/bankmini/dashboard');
            case 'toko':
                return redirect('/toko/dashboard');
            case 'siswa':
                return redirect('/siswa/dashboard');
            default:
                return redirect('/');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function home(Request $request)
    {
        $query = \App\Models\Product::query();
        if ($request->filled('q')) {
            $query->where('name', 'like', '%'.$request->q.'%');
        }
        $products = $query->orderBy('created_at', 'desc')->get();
        return view('index', compact('products'));
    }

    public function boot(): void
    {
        Gate::define('isToko', function ($user) {
            return $user->role === 'toko';
        });
    }
} 