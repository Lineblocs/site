<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Add calls to Seeders here
        $this->command->info('Creating service plans');
        $this->call(ServicePlanSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->command->info('Admin User created with username admin@admin.com and password admin');
        $this->command->info('Test User created with username user@user.com and password user');
        $this->command->info('Created default service plans.');
        $this->call(FlowTableSeeder::class);
        $this->call(PoliciesSeeder::class);
        $this->call(LoadSampleCalls::class);
        $this->call(PhoneDefSeeder::class);
        $this->call(LoadPhoneData::class);
        $this->call(LoadBasicData::class);

        // create any singleton records such as customizations and settings
        Model::reguard();
    }
}
