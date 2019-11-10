<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'id'=>1,
            'name' => 'eastPark',
            'description' =>'project',
            'cityId' =>1,
        ]);
    }
}
