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
            'name' => 'done',
            'order' => 0,
        ]);
        DB::table('actions')->insert([
            'id' => 2,
            'name' => 'following',
            'order' => 0,
        ]);

        DB::table('actions')->insert([
            'id' => 3,
            'name' => 'comingVisit',
            'order' => 0,
        ]);
        DB::table('actions')->insert([
            'id' => 4,
            'name' => 'meeting',
            'order' => 0,
        ]);

        DB::table('actions')->insert([
            'id' => 5,
            'name' => 'cancellation',
            'order' => 0,
        ]);
        DB::table('actions')->insert([
            'id' => 6,
            'name' => 'notInterested',
            'order' => 0,
        ]);
    }
}
