<?php

use Illuminate\Database\Seeder;

class TeamsProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_team')->insert([
            'id'=>10,
            'projectId' => 1,
            'teamId' => 10,
        ]);
    }
}
