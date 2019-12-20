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
            'id' => 1,
            'name' => 'Done Deal',
            'order' => 6,
        ]);
        DB::table('actions')->insert([
            'id' => 2,
            'name' => 'Following',
            'order' => 1,
        ]);

        DB::table('actions')->insert([
            'id' => 3,
            'name' => 'Coming Visit',
            'order' => 4,
        ]);
        DB::table('actions')->insert([
            'id' => 4,
            'name' => 'Meeting',
            'order' => 2,
        ]);

        DB::table('actions')->insert([
            'id' => 11,
            'name' => 'Invitation',
            'order' => 3,
        ]);

        DB::table('actions')->insert([
            'id' => 5,
            'name' => 'Scouting',
            'order' => 5,
        ]);

        DB::table('actions')->insert([
            'id' => 6,
            'name' => 'Convert to another project',
            'order' => 7,
        ]);
        DB::table('actions')->insert([
            'id' => 7,
            'name' => 'No Answer',
            'order' => 8,
        ]);
        DB::table('actions')->insert([
            'id' => 8,
            'name' => 'Not Available Or Closed',
            'order' => 9,
        ]);
        DB::table('actions')->insert([
            'id' => 9,
            'name' => 'Low Budget',
            'order' => 10,
        ]);
        DB::table('actions')->insert([
            'id' => 10,
            'name' => 'Trash',
            'order' => 11,
        ]);
    }

}
