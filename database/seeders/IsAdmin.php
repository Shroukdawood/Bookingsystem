<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class IsAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
    'name' => 'Admin',
    'username'=>'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'phone'=>'0111111111111',
    'is_admin' => true
    ]);
}}
