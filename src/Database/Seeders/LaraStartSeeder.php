<?php

namespace Mrba\LaraHper\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LaraStartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userModel = config('larahper.database.users_model');
        $userModel::truncate();
        $userModel::create([
            'name' => 'administrator',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'phone' => '12345678888',
            'openid' => 'admin@example.com',
            'password' => Hash::make('admin'),
        ]);
    }
}
