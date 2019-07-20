<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'username' => 'admin',
            'password' => bcrypt('secret'),
            'type' => 1,
            'credits' => 0,
        ]);
        DB::table('users')->insert([
            'username' => 'user',
            'password' => bcrypt('secret'),
            'type' => 2,
            'credits' => 20,
        ]);
        DB::table('users')->insert([
            'username' => 'pro',
            'password' => bcrypt('secret'),
            'type' => 3,
            'credits' => 40,
        ]);
    }
}
