<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\User::create([
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'phone' => '123123123',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('verysafepassword'),
            'role' => 1,
            'is_active' => 1,
        ]);
    }
}
