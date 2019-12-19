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
            'name' => 'admin',
            'userName' => 'admin',
            'email' =>  'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'roleId' => 2,
            'createdBy' =>0,
        ]);

        DB::table('users')->insert([
            'name' => 'saleMan',
            'userName' => 'saleMan',
            'email' =>  'sale@gmail.com',
            'password' => bcrypt('12345678'),
            'roleId' => 4,
            'createdBy' =>0,
            'teamId' =>10,
        ]);
        DB::table('users')->insert([
            'id'=>10,
            'name' => 'teamLeader',
            'userName' => 'teamLeader',
            'email' =>  'teamLeader@gmail.com',
            'password' => bcrypt('12345678'),
            'roleId' => 3,
            'createdBy' =>0,
        ]);
        DB::table('users')->insert([
            'id'=>11,
            'name' => 'Marketer',
            'userName' => 'marketer',
            'email' =>  'marketer@gmail.com',
            'password' => bcrypt('12345678'),
            'roleId' => 6,
            'createdBy' =>0,
        ]);
    }
}
