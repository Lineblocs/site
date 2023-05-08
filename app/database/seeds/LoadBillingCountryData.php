<?php

use Illuminate\Database\Seeder;
use App\BillingCountry;
use App\BillingRegion;

class LoadBillingCountryData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // get country data from here
        // https://gist.githubusercontent.com/ebaranov/41bf38fdb1a2cb19a781/raw/fb097a60427717b262d5058633590749f366bd80/gistfile1.json
        $usaBilling = BillingCountry::create([
            'name' => 'United States',
            'iso' => 'us'
        ]);
        $states = ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "District of Columbia", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"];
        foreach ( $states as $state ) {
            $shortName = $state;
            BillingRegion::create([
                'name' => $state,
                'short_name' => $shortName,
                'billing_country_id' => $usaBilling->id
            ]);
        }
        $canadaBilling = BillingCountry::create([
            'name' => 'Canada',
            'iso' => 'ca'
        ]);
        $states = ["Alberta", "British Columbia", "Manitoba", "New Brunswick", "Newfoundland and Labrador", "Northwest Territories", "Nova Scotia", "Nunavut", "Ontario", "Prince Edward Island", "Quebec", "Saskatchewan", "Yukon Territory"];

        foreach ( $states as $state ) {
            $shortName = $state;
            BillingRegion::create([
                'name' => $state,
                'short_name' => $shortName,
                'billing_country_id' => $canadaBilling->id
            ]);
        }
    }
}
