<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // password semua akun: "password"
        User::updateOrCreate(['email' => 'admin@example.com'],  ['name' => 'Admin Toko',  'password' => 'password', 'role' => 'admin']);
        User::updateOrCreate(['email' => 'editor@example.com'], ['name' => 'Editor Toko', 'password' => 'password', 'role' => 'editor']);
        User::updateOrCreate(['email' => 'user@example.com'],   ['name' => 'Budi Pelanggan', 'password' => 'password', 'role' => 'user']);

        User::factory(10)->create(['role' => 'user']);
    }
}
