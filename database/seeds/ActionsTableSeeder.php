<?php

use Illuminate\Database\Seeder;

class ActionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('actions')->insert([
            'id' => 2,
            'name' => 'Following',
            'order' => 1,
        ]);
        DB::table('actions')->insert([
            'id' => 12,
            'name' => 'VIP Following',
            'order' => 2,
        ]);
        DB::table('actions')->insert([
            'id' => 4,
            'name' => 'Meeting',
            'order' => 3,
        ]);
        DB::table('actions')->insert([
            'id' => 11,
            'name' => 'Invitation',
            'order' => 4,
        ]);
        DB::table('actions')->insert([
            'id' => 3,
            'name' => 'Coming Visit',
            'order' => 5,
        ]);
        DB::table('actions')->insert([
            'id' => 13,
            'name' => 'Dubai Visit',
            'order' => 6,
        ]);

        DB::table('actions')->insert([
            'id' => 5,
            'name' => 'Scouting',
            'order' => 7,
        ]);
        DB::table('actions')->insert([
            'id' => 1,
            'name' => 'Done Deal',
            'order' => 8,
        ]);

        DB::table('actions')->insert([
            'id' => 6,
            'name' => 'Convert to another project',
            'order' => 9,
        ]);
        DB::table('actions')->insert([
            'id' => 7,
            'name' => 'No Answer',
            'order' =>10,
        ]);
        DB::table('actions')->insert([
            'id' => 8,
            'name' => 'Not Available Or Closed',
            'order' => 11,
        ]);
        DB::table('actions')->insert([
            'id' => 9,
            'name' => 'Low Budget',
            'order' => 12,
        ]);
        DB::table('actions')->insert([
            'id' => 14,
            'name' => 'Not Interested',
            'order' => 13,
        ]);
        DB::table('actions')->insert([
            'id' => 10,
            'name' => 'Trash',
            'order' => 14,
        ]);

    }
}
