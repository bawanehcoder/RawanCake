<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin=Admin::create([
            'name'=>'admin jo-life',
            'email'=>'admin@jo-life.com',
            'role'=>'admin_1',
            'blob'=>'user-admin',
            'password'=>Hash::make('admin1'),
            'avatar'=>'assets/img/avatar.png',
        ]);
        $admin->assignRole('admin_1');
    }
}
