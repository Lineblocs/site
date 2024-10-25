<?php

use Illuminate\Database\Seeder;
use App\Helpers\MainHelper;
use App\Helpers\SIPRouterHelper;
use App\Workspace;
use App\WorkspaceUser;
use App\PlanUsagePeriod;
use App\Customizations;
use App\CustomizationsGroup2;
use App\ApiCredential;
use App\ApiCredentialGroup2;
use App\ServicePlan;
class UserTableSeeder extends Seeder {

public function run()
{
  $plans = ServicePlan::getRecurringMembershipPlans();
  $plan = $plans[0];
  $admin = \App\User::create([
    'name' => 'Admin User',
    'username' => 'admin_user',
    'email' => \App\Helpers\MainHelper::createEmail('support'),
    'password' => bcrypt('jY4xm8<9Hw6`yp/L'),
    'confirmed' => 1,
    'admin' => 1,
    'mobile_number' => 'ADMIN',
    'office_number' => 'ADMIN',
    'confirmation_code' => md5(microtime() . env('APP_KEY')),
    'region' => 'ca-central-1',
    'plan' => $plan->name,
    'stripe_id' => 'cus_HPMybdGfNCjbIl'
  ]);
    $workspace = Workspace::create([
      'creator_id' => $admin->id,
      'name' => 'admin',
      'api_token' => MainHelper::createAPIToken(),
      'api_secret' => MainHelper::createAPISecret(),
      'plan' => $plan->name,
    ]);
WorkspaceUser::createSuperAdmin($workspace, $admin);
  SIPRouterHelper::addUserToProxy($admin->toArray(), $workspace->toArray());


  $user = \App\User::create([
        'name' => 'Test User',
			'username' => 'test_user',
			'email' => 'user@lineblocs.com',
			'password' => bcrypt('GQv>jcJ4{3K!S%"^'),
			'confirmed' => 1,
			'confirmation_code' => md5(microtime() . env('APP_KEY')),
			'mobile_number' => 'USER',
			'office_number' => 'USER',
      'region' => 'ca-central-1',
      'plan' => $plan->name,
      'stripe_id' => 'cus_HPMybdGfNCjbIl'
		]);
      $workspace = Workspace::create([
        'creator_id' => $user->id,
        'name' => 'workspace',
        'api_token' => MainHelper::createAPIToken(),
        'api_secret' => MainHelper::createAPISecret(),
        'plan' => $plan->name
    ]);
    WorkspaceUser::createSuperAdmin($workspace, $user);
        PlanUsagePeriod::create(['workspace_id' => $workspace->id, 'started_at' => new \DateTime(), 'active' => TRUE]);
    SIPRouterHelper::addUserToProxy($user->toArray(), $workspace->toArray());
    Customizations::create();
    CustomizationsGroup2::create();
    ApiCredential::create();
    ApiCredentialGroup2::create();
	}

}
