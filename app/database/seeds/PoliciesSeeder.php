<?php

use Illuminate\Database\Seeder;
use App\PolicyPage;

function get_policy_content($page) {
    $content = file_get_contents( base_path("policies/" . $page . ".html") );
    return $content;
}
class PoliciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $policy = get_policy_content('privacy_policy');
        $terms = get_policy_content('terms_of_service');
        $sla = get_policy_content('service_level_agreeement');
        PolicyPage::create([
            'privacy_policy' => $policy,
            'terms_of_service' => $terms,
            'service_level_agreement' => $sla,
        ]);
    }
}
