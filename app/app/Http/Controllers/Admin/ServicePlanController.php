<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\ServicePlan;
use App\ServicePlanDialPrefix;
use App\Workspace;
use App\PortNumber;
use App\Subscription;
use App\WorkspaceUser;
use App\Http\Requests\Admin\ServicePlanRequest;
use App\Helpers\MainHelper;
use Datatables;
use DB;
use Config;
use Mail;
use Illuminate\Http\Request;

class ServicePlanController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'serviceplan');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.serviceplan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $features = $this->getFeatureOptions();
        $callDurations = $this->getCallDurations();
        $recordingSpace = $this->getRecordingSpaceOptions();
        return view('admin.serviceplan.create_edit', compact('features', 'callDurations', 'recordingSpace'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ServicePlanRequest $request)
    {
        $data = $request->all();
        $serviceplan = new ServicePlan ($data);
        $serviceplan->save();
        $this->ensurePlansDontContainConflictingValues($serviceplan);
    }

    // make all plans featured except selected one
    private function ensurePlansDontContainConflictingValues( $serviceplan ) {
        if ( $serviceplan->featured_plan ) {
            DB::table('service_plans')->where('id', '!=', $serviceplan->id)->update([
                'featured_plan' => '0'
            ]);
        }
        if ( $serviceplan->registration_plan ) {
            DB::table('service_plans')->where('id', '!=', $serviceplan->id)->update([
                'registration_plan' => '0'
            ]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(ServicePlan $serviceplan)
    {
        $features = $this->getFeatureOptions();
        $callDurations = $this->getCallDurations();
        $recordingSpace = $this->getRecordingSpaceOptions();
        $migratePlans = [];
        $allPlans = ServicePlan::where('id', '!=', $serviceplan->id)->get()->toArray();
        foreach ($allPlans as $key => $plan) {
            $migratePlans[$plan['nice_name']] = $plan['nice_name'] . ' (' . $plan['key_name'] . ')';
        }
        return view('admin.serviceplan.create_edit', compact('serviceplan', 'features', 'callDurations', 'recordingSpace', 'migratePlans'));
    }
    /**
     * Migrate all users on this service plan to a target service plan.
     *
     * @param Request $request
     * @param ServicePlan $serviceplan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function migrate(Request $request, ServicePlan $serviceplan)
    {
        try {
            $targetPlanNiceName = $request->input('migrate_plan');
            
            if (!$targetPlanNiceName) {
                return redirect()->back()->withErrors(['migrate_plan' => 'Please select a target plan for migration.']);
            }

            $targetPlan = ServicePlan::where('nice_name', $targetPlanNiceName)->first();

            if (!$targetPlan) {
                return redirect()->back()->withErrors(['migrate_plan' => 'Target service plan not found.']);
            }

            if ($targetPlan->id === $serviceplan->id) {
                return redirect()->back()->withErrors(['migrate_plan' => 'Cannot migrate to the exact same plan.']);
            }

            DB::beginTransaction();
            $subscriptionsToMigrate = Subscription::where('current_plan_id', $serviceplan->id)->get();
            $subscriptionsToMigrate = Subscription::join('workspaces', 'subscriptions.workspace_id', '=', 'workspaces.id')
                ->join('users', 'workspaces.creator_id', '=', 'users.id')
                ->where('subscriptions.current_plan_id', $serviceplan->id)
                ->select('subscriptions.*', 'users.email as user_email')
                ->get();

            foreach ($subscriptionsToMigrate as $subscription) {
                $workspaceUsers = WorkspaceUser::join('users', 'workspace_users.user_id', '=', 'users.id')
                                    ->where('workspace_users.workspace_id', $subscription->workspace_id)
                                    ->select('workspace_users.*', 'users.email')
                                    ->get();
                                // 
                foreach ($workspaceUsers as $workspaceUser) {
                    $user = User::find($workspaceUser->user_id);
                    if ($user && $user->email) {
                        $mailData = [
                            'currentPlan' => $serviceplan,
                            'newPlan' => $targetPlan,
                        ];

                        Mail::send('emails.service_plan_being_migrated', $mailData, function($message) use ($user) {
                            $message->to($user->email)
                                    ->subject('Important: Service Plan Update');
                        });
                    }
                }
            }
            Subscription::where('current_plan_id', $serviceplan->id)->update([
                'scheduled_plan_id' => $targetPlan->id,
                'scheduled_effective_date' => \Carbon\Carbon::now()
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Users successfully scheduled for migration.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Service Plan Migration Error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'A system error occurred during migration. Please try again.']);
        }
    }
    private function createFeatureOption($key) {
        return [
            'key' => $key
        ];
}

    private function getFeatureOptions() {
        return [
$this->createFeatureOption('allows_monthly'),
            $this->createFeatureOption('allows_annual'),
            $this->createFeatureOption('fax'),
            $this->createFeatureOption('im_integrations'),
            $this->createFeatureOption('productivity_integrations'),
            $this->createFeatureOption('voice_analytics'),
            $this->createFeatureOption('fraud_protection'),
            $this->createFeatureOption('crm_integrations'),
            $this->createFeatureOption('programmable_toolkit'),
            $this->createFeatureOption('sso'),
            $this->createFeatureOption('provisioner'),
            $this->createFeatureOption('vpn'),
            $this->createFeatureOption('multiple_sip_domains'),
            $this->createFeatureOption('bring_carrier'),
            $this->createFeatureOption('featured_plan'),
            $this->createFeatureOption('pay_as_you_go'),
            $this->createFeatureOption('include_in_pricing_pages'),
        ];
    }

    private function getCallDurations() {
        return [
            '30' => '30 minutes',
            '60' => '60 minutes',
            '120' => '120 minutes',
            'UNLIMITED' => 'UNLIMITED'
        ];
    }

    private function getRecordingSpaceOptions() {
        return [
            '256gb' => '256gb',
            '512gb' => '512gb',
            '1024gb' => '1024gb'
        ];
    }
    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(ServicePlanRequest $request, ServicePlan $serviceplan)
    {
        $data = $request->all();
        $serviceplan->update($data);
        $this->ensurePlansDontContainConflictingValues($serviceplan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(ServicePlan $serviceplan)
    {
        $subscriptions = Subscription::where('current_plan_id', $serviceplan->id)->count();
        
        $canDelete = true;
        if ($subscriptions > 0) {
            $canDelete = false;
            $message = 'This plan cannot be deleted until all users migrate to another plan.';
            return view('admin.serviceplan.delete', compact('serviceplan', 'canDelete', 'message'));
        }
        return view('admin.serviceplan.delete', compact('serviceplan', 'canDelete'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(ServicePlan $serviceplan)
    {
        $serviceplan->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $serviceplans = ServicePlan::select(array('service_plans.id', 'service_plans.key_name', 'service_plans.nice_name', 'service_plans.featured_plan', 'service_plans.rank', 'service_plans.created_at'));

        return Datatables::of($serviceplans)
            ->add_column('actions', '<a href="{{{ url(\'admin/serviceplan/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/serviceplan/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')

            ->edit_column('featured_plan', '@if ($featured_plan=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->remove_column('id')
            ->make();
    }

}
