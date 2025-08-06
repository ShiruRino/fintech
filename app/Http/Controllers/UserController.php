<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function create()
    {
        return view('admin.user_create');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user_edit', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'role' => ['required', Rule::in(['administrator', 'bankmini', 'toko', 'siswa'])]
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'name' => $validated['name'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role']
        ]);

        $user->wallet()->create(['balance' => 0]);

        return redirect('/users')->with('success', 'User berhasil ditambahkan.');
    }

    public function show($id)
    {
        $user = User::with('wallet')->findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'username' => ['sometimes', Rule::unique('users')->ignore($user->id)],
            'name' => 'sometimes|string|max:255',
            'password' => 'sometimes|string|min:6',
            'role' => ['sometimes', Rule::in(['administrator', 'bankmini', 'toko', 'siswa'])]
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return redirect('/users')->with('success', 'User berhasil diupdate.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('success', 'User berhasil dihapus.');
    }
}
