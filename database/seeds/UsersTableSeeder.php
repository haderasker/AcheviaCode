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
            'id' =>100,
            'name' => 'admin',
            'userName' => 'admin',
            'email' =>  'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'roleId' => 2,
        ]);
    }
}
