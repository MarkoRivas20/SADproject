<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Marko Antonio Rivas Rios',
            'email' => 'dtinformatica@coopaccuajone.com',
            'password' => Hash::make('cuajone19')
        ])->assignRole('Admin');
    }
}
