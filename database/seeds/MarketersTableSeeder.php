<?php

use Illuminate\Database\Seeder;

class MarketersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marketers')->insert([
            'id' => 1,
            'name' => 'anos',
            'campaignId' => 1,

        ]);
        DB::table('marketers')->insert([
            'id' => 2,
            'name' => 'hadeer',
            'campaignId' => 1,

        ]);

        DB::table('marketers')->insert([
            'id' => 3,
            'name' => 'anas',
            'campaignId' => 2,

        ]);

        DB::table('marketers')->insert([
            'id' => 4,
            'name' => 'sakr',
            'campaignId' => 2,

        ]);
    }
}
