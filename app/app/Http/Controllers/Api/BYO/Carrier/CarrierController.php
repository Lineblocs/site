<?php

namespace App\Http\Controllers\Api\BYO\Carrier;
use \App\Http\Controllers\Api\BYO\BYOController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\BYOCarrier; 
use \App\BYOCarrierRoute; 
use \App\Transformers\CarrierTransformer;
use \DB;
use App\Helpers\MainHelper;
use App\Helpers\WorkspaceHelper;
use Mail;
use Config;



class BYOCarrierController extends BYOController {
    public function carrierData(Request $request, $carrierId)
    {
        $carrier = BYOCarrier::where('public_id', '=', $carrierId)->firstOrFail();
        if (!$this->hasPermissions($request, $carrier, 'manage_byo_carriers')) {
            return $this->response->errorForbidden();
        }

        return $this->response->array($array);
    }
    public function listCarriers(Request $request)
    {
        $user = $this->getUser($request);
        $paginate = $this->getPaginate( $request );
      $workspace = $workspace = $this->getWorkspace($request); 
        $carriers = BYOCarrier::where('workspace_id', $workspace->id);
        MainHelper::addSearch($request, $carriers, ['name']);
        return $this->response->paginator($carriers->paginate($paginate), new CarrierTransformer);
    }

    public function deleteCarrier(Request $request, $carrierId)
    {
        $carrier = BYOCarrier::findOrFail($carrierId);
        if (!$this->hasPermissions($request, $carrier, 'manage_byo_carriers')) {
            return $this->response->errorForbidden();
        }
        $carrier->delete();
   }
    public function updateCarrier(Request $request, $carrierId)
    {
        $data = $request->json()->all();
        $carrier = BYOCarrier::where('public_id', $carrierId)->firstOrFail();
        if (!$this->hasPermissions($request, $carrier, 'manage_byo_carriers')) {
            return $this->response->errorForbidden();
        }
        $routes = $data['routes'];
        unset( $data['routes'] );

        $carrier->update($data);
        $this->saveCarrierRoutes($carrier, $routes);
   }
    public function saveCarrier(Request $request)
    {
        $data = $request->all();
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        if (!WorkspaceHelper::canPerformAction($user, $workspace, 'create_byo_carrier')) {
          return $this->errorPerformingAction();
        }
        $routes = $data['routes'];
        unset( $data['routes'] );
        $carrier = BYOCarrier::create( $data );
        $this->saveCarrierRoutes($carrier, $routes);
        return $this->response->noContent()->withHeader('X-Carrier-ID', $carrier->id);
    }

    private function saveCarrierRoutes($carrier, $routes) {
        $current = BYOCarrierRoute::where('carrier_id', $carrier->id)->get();
        foreach ($routes as $route) {
          $params = $route;
          if (!empty($route['id'])) {
            foreach ($current as $value) {
              if ($value->id == $route['id']) {
                $value->update( $params );
              }
            }
          } else {
            BYOCarrierRoute::create(array_merge($params, [
              'carrier_id' => $carrier->id
            ]));
          }
        }        
        foreach ($current as $item) {
          $found = FALSE;
          foreach ($routes as $route) {
            if (!empty($route['id']) && $route['id'] == $item->id) {
              $found = TRUE;
            }
          }
          if (!$found) {
            $item->delete(); 
          }
        }
            
    }

}
