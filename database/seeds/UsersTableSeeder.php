<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'phone' => '081234567890',
            'address' => 'Address',
            'password' => bcrypt('admin'),
            'role' => 'Admin',
        ]);
    }
}
