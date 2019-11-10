<?php

use Illuminate\Database\Seeder;

class MethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('via_methods')->insert([
            'id' => 1,
            'name' => 'phone',

        ]);
        DB::table('via_methods')->insert([
            'id' => 2,
            'name' => 'whats',

        ]);

        DB::table('via_methods')->insert([
            'id' => 3,
            'name' => 'email',

        ]);
        DB::table('via_methods')->insert([
            'id' => 4,
            'name' => 'visit',

        ]);
    }
}
