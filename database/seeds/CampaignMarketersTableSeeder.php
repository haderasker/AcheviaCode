<?php

use Illuminate\Database\Seeder;

class CampaignMarketersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaign_marketers')->insert([
            'id' => 1,
            'marketerId' => 11,
            'campaignId' => 1,

        ]);

        DB::table('campaign_marketers')->insert([
            'id' => 2,
            'marketerId' => 11,
            'campaignId' => 2,
        ]);

    }
}
