<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\AuctionCenter;
use App\Models\Color;
use App\Models\Feature;
use App\Models\Make;
use App\Models\Membership;
use App\Models\Package;
use App\Models\ModelVariant;
use App\Models\Plan;
use App\Models\PlanFeature;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Services\AuctionService;
use Carbon\Carbon;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class FeatureController extends Controller
{

      public function index(Request $request)
    {

        $length = $request->input('length', 50);
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $length;


        //Query
        $query = Feature::with(['plans:plan_id,feature_id']);

        //Filter
        if($request->has('id') && $request->id != ''){
            $query->where('id',$request->id);
        }
        
     
            $data = [];
            $plans = Plan::all();
            foreach ($plans as $p => $value) {
                
                $data[$p]['id'] = $value->id;
                $data[$p]['title'] = $value->plan_name;

                foreach (Feature::all() as $f => $feature) {
                    $data[$p]['features'][$f]['id'] = $feature->id;
                    $data[$p]['features'][$f]['title'] = Str::title(str_replace(['-', '_'], ' ', $feature->name));
                    $data[$p]['features'][$f]['status'] = PlanFeature::where('plan_id',$value->id)
                                                            ->where('feature_id',$feature->id)
                                                            ->exists();
                }
            }
            

        return response()->json([
            'total'  => count($data),
            'data'   => $data,
        ]);


    }


    
       public function handleStatus(Request $request)
    {

            $validator = Validator::make($request->all(),[
                'plan_id' => 'required|exists:plans,id',
                'feature_id' => 'required|exists:features,id'
            ]);

            if($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'errors' => $validator->errors()
                ], 422);
            }

            if($model = PlanFeature::where('plan_id',$request->plan_id)->where('feature_id',$request->feature_id)->first()){
                $model->delete();
            }else{
                $model = PlanFeature::create([
                    'plan_id' => $request->plan_id ,
                    'feature_id' => $request->feature_id
                ]);
            }

            return response()->json([
                'message' => 'Record Updated Successfully',
                'data' => $model
            ],200);   

    }



  

}
