<?php

use Illuminate\Database\Seeder;
use App\PhoneDefinition;
class PhoneDefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PhoneDefinition::create([
            'phone_type' => 1,
            'manufacturer' => 'Grandstream',
            'model' => 'GXP2130'
        ]);
        PhoneDefinition::create([
            'phone_type' => 2,
            'manufacturer' => 'Grandstream',
            'model' => 'GXP2140'
        ]);
        PhoneDefinition::create([
            'phone_type' => 3,
            'manufacturer' => 'Grandstream',
            'model' => 'GXP2160'
        ]);
         PhoneDefinition::create([
            'phone_type' => 4,
            'manufacturer' => 'Grandstream',
            'model' => 'GXW4248'
        ]);
        PhoneDefinition::create([
            'phone_type' => 5,
            'manufacturer' => 'Grandstream',
            'model' => 'GXW4224'
        ]);

        PhoneDefinition::create([
            'phone_type' =>6,
            'manufacturer' => 'Grandstream',
            'model' => 'GXW4216'
        ]);



        PhoneDefinition::create([
            'phone_type' =>7,
            'manufacturer' => 'Cisco',
            'model' => 'SPA303G'
        ]);
        PhoneDefinition::create([
            'phone_type' =>8,
            'manufacturer' => 'Cisco',
            'model' => 'SPA504G'
        ]);
        PhoneDefinition::create([
            'phone_type' =>9,
            'manufacturer' => 'Cisco',
            'model' => 'SPA508G'
        ]);
        PhoneDefinition::create([
            'phone_type' =>9,
            'manufacturer' => 'Cisco',
            'model' => 'SPA509G'
        ]);
        PhoneDefinition::create([
            'phone_type' =>10,
            'manufacturer' => 'Cisco',
            'model' => 'SPA514G'
        ]);
        PhoneDefinition::create([
            'phone_type' =>11,
            'manufacturer' => 'Polycom',
            'model' => 'IP330'
        ]);
        PhoneDefinition::create([
            'phone_type' =>12,
            'manufacturer' => 'Polycom',
            'model' => 'IP331'
        ]);





    }
}
