<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
        User::Create([
            'name'=>'Admin User',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('admin@123'),
            'role'=>'admin'
        ]);


        User::Create([
            'name'=>'User',
            'email'=>'user@gmail.com',
            'password'=>Hash::make('user@123'),
            'role'=>'user',
        ]);




    }
}
