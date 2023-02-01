<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\ServicePlan;
use App\ServicePlanDialPrefix;
use App\Workspace;
use App\PortNumber;
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
        return view('admin.serviceplan.create_edit', compact('features'));
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
        $this->updatePlansForFeaturedSetting( $serviceplan );
    }

    // make all plans featured except selected one
    private function updatePlansForFeaturedSetting( $serviceplan ) {
        if ( $serviceplan->featured_plan ) {
            DB::table('service_plans')->where('id', '!=', $serviceplan->id)->update([
                'featured_plan' => '0'
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
        return view('admin.serviceplan.create_edit', compact('serviceplan', 'features'));
    }
    private function createFeatureOption($key) {
        return [
            'key' => $key
        ];
    }

    private function getFeatureOptions() {
        return [
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
        $this->updatePlansForFeaturedSetting( $serviceplan );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(ServicePlan $serviceplan)
    {
        return view('admin.serviceplan.delete', compact('plan'));
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
        $serviceplans = ServicePlan::select(array('service_plans.id', 'service_plans.key_name', 'service_plans.nice_name', 'service_plans.featured_plan', 'service_plans.created_at'));

        return Datatables::of($serviceplans)
            ->add_column('actions', '<a href="{{{ url(\'admin/serviceplan/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/serviceplan/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')

            ->edit_column('featured_plan', '@if ($featured_plan=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->remove_column('id')
            ->make();
    }

}
