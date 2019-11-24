<?php

use Illuminate\Database\Seeder;

class CampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaigns')->insert([
            'id' => 1,
            'name' => 'campaign1',
            'description' => 'd',
            'projectId' => 1,

        ]);
        DB::table('campaigns')->insert([
            'id' => 2,
            'name' => 'campaign2',
            'description' => 'a',
            'projectId' => 1,

        ]);

        DB::table('campaigns')->insert([
            'id' => 3,
            'name' => 'campaign3',
            'description' => 's',
            'projectId' => 1,

        ]);

    }
}
