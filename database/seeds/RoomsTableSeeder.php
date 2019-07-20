<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            'user_id' => 1,
            'name' => 'Dummy Room',
            'city' => 'Forbidden City',
            'price' => 1000000,
            'availability' => 999,
        ]);
    }
}
