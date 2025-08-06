<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'username' => 'admin'
        ], [
            'name' => 'admin',
            'password' => Hash::make('admin1234'),
            'role' => 'administrator'
        ]);
        User::updateOrCreate([
            'username' => 'kantin'
        ], [
            'name' => 'kantin',
            'password' => Hash::make('kantin1234'),
            'role' => 'toko'
        ]);

        User::updateOrCreate([
            'username' => 'bank'
        ], [
            'name' => 'bank',
            'password' => Hash::make('bank1234'),
            'role' => 'bankmini'
        ]);
        User::updateOrCreate([
            'username' => 'siswa'
        ], [
            'name' => 'siswa',
            'password' => Hash::make('siswa1234'),
            'role' => 'siswa'
        ]);

    }
}
