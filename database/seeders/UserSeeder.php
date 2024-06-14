<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
                'first_name'    => "admin",
                'last_name'    => "admin",
                'email'    => "admin". '@gmail.com',
                'role' => 'admin',
                'phone' => '123',
                'password'    => bcrypt('admin123')
        ]);
    }
}