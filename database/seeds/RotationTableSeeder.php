<?php

use Illuminate\Database\Seeder;

class RotationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rotations_auto')->insert([
            'name' => 'rotation',
            'type' => 1,
        ]);
    }
}
