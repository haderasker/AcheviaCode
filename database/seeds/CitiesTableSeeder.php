<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_cities')->insert([
            'id'=>1,
            'name' => 'nasrCity',
            'description' =>'city',
        ]);
    }
}
