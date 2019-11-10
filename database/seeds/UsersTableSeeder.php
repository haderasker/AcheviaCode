<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'userName' => Str::random(10),
            'email' => Str::random(10) . '@gmail.com',
            'password' => bcrypt('12345678'),
            'roleId' => 1,
            'createdBy' =>0,
        ]);

        DB::table('users')->insert([
            'name' => Str::random(10),
            'userName' => Str::random(10),
            'email' => Str::random(10) . '@gmail.com',
            'password' => bcrypt('12345678'),
            'roleId' => 4,
            'createdBy' =>0,
            'teamId' =>10,
        ]);
        DB::table('users')->insert([
            'id'=>10,
            'name' => Str::random(10),
            'userName' => Str::random(10),
            'email' => Str::random(10) . '@gmail.com',
            'password' => bcrypt('12345678'),
            'roleId' => 3,
            'createdBy' =>0,
        ]);
    }
}
