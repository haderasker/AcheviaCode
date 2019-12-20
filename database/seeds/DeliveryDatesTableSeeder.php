<?php

use Illuminate\Database\Seeder;

class DeliveryDatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery_dates')->insert([
            'id' => 1,
            'name' => 'immediate receipt',
        ]);
        DB::table('delivery_dates')->insert([
            'id' => 2,
            'name' => '6 months',
        ]);
        DB::table('delivery_dates')->insert([
            'id' => 3,
            'name' => '1 year',
        ]);
        DB::table('delivery_dates')->insert([
            'id' => 4,
            'name' => '2 years',
        ]);
        DB::table('delivery_dates')->insert([
            'id' => 5,
            'name' => '3 years',
        ]);
        DB::table('delivery_dates')->insert([
            'id' => 6,
            'name' => '4 years',
        ]);
        DB::table('delivery_dates')->insert([
            'id' => 7,
            'name' => '5 years',
        ]);
        DB::table('delivery_dates')->insert([
            'id' => 8,
            'name' => '6 years',
        ]);
    }
}
