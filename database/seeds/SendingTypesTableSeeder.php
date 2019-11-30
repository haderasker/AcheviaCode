<?php

use Illuminate\Database\Seeder;

class SendingTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sending_types')->insert([
            'id'=>1,
            'name' => 'welcome',
        ]);
        DB::table('sending_types')->insert([
            'id'=>2,
            'name' => 'coming visit',
        ]);
        DB::table('sending_types')->insert([
            'id'=>3,
            'name' => 'assign',
        ]);
        DB::table('sending_types')->insert([
            'id'=>4,
            'name' => 'no replay',
        ]);
        DB::table('sending_types')->insert([
            'id'=>5,
            'name' => 'switched off',
        ]);
        DB::table('sending_types')->insert([
            'id'=>6,
            'name' => 'campaign',
        ]);

    }
}

