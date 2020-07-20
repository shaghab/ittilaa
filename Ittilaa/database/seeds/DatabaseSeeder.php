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
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(RegionSeeder::class);
        $this->call(MinistrySeeder::class);
        $this->call(DivisionSeeder::class);
        
        $this->call(NotificationSeeder::class);
    }
}
