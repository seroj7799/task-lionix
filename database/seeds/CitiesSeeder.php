<?php

use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            ['name' => 'Yerevan', 'latitude' => 40.18, 'longitude' => 44.51,],
            ['name' => 'Kapan', 'latitude' => 39.21, 'longitude' => 46.41,]
        ]);
    }
}
