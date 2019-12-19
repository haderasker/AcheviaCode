<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RolesTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(ActionsTableSeeder::class);
         $this->call(MethodsTableSeeder::class);
         $this->call(CitiesTableSeeder::class);
         $this->call(ProjectsTableSeeder::class);
         $this->call(TeamsTableSeeder::class);
         $this->call(TeamsProjectTableSeeder::class);
        $this->call(CampaignsTableSeeder::class);
        $this->call(DeliveryDatesTableSeeder::class);
        $this->call(SendingTypesTableSeeder::class);
        $this->call(RotationTableSeeder::class);
        $this->call(CampaignMarketersTableSeeder::class);
    }
}
