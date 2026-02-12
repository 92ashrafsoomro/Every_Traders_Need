<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\AuctionCenter;
use App\Models\Color;
use App\Models\Make;
use App\Models\Membership;
use App\Models\MembershipPlan;
use App\Models\ModelVariant;
use App\Models\Plan;
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


class PlanController extends Controller
{

      public function index(Request $request)
    {

        $length = $request->input('length', 50);
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $length;

        //Query
        $query = MembershipPlan::query();

        //Filter
        if($request->has('id') && $request->id != '') {
            $query->where('id',$request->id);
        }
        
        $count = (clone $query)->count();
        $data = $query->select([
                    'membership_plans.*',
                ])
                ->skip($offset)
                ->take($length)
                ->orderByDesc('id')
                ->get()
                ->map(function($item){
                    if (!empty($item->description)) {
                            $item->description = json_decode($item->description, true);
                        }
                    return $item;
                });
            

        return response()->json([
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'page' => $page,
            'offset' => $offset,
            'last_page' => ceil($count / $length),
            'data' => $data,
        ]);


    }



      public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'plan_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'short_desc' =>  'required|string|max:255',
            'description' => 'nullable|array',
            'duration_unit' =>  'required|in:month,week,year|max:255',
            'duration_value' =>  'required|numeric|min:0',
            'status' =>  'required|integer|in:0,1|max:255',
            'is_officer' =>  'required|integer|in:0,1|max:255',
            'sort_by' =>  'required|numeric|min:0',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $model = MembershipPlan::create([
            'plan_name' => $request->plan_name,
            'price' => $request->price,
            'discount' => $request->discount,
            'short_desc' => $request->short_desc, 
            'description' => json_encode($request->description,true) ?? [] ,
            'duration_unit' => $request->duration_unit,
            'duration_value' => $request->duration_value,
            'status' => $request->status,
            'is_officer' => $request->is_officer,
            'sort_by' => $request->sort_by,
            'created_at' => Carbon::now(),
            'updated_at' => NULL,
        ]);

        return response()->json([
            'message' => 'Record Created Successfully',
            'data' => $model
        ],200);

    }


    
       public function update(Request $request,$id)
    {

        $model = MembershipPlan::find($id);
        if(!$model){
            return response()->json([
                'message' => 'Record Not Found',
            ], 422);
        }

        $validator = Validator::make($request->all(),[
            'plan_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'short_desc' =>  'required|string|max:255',
            'description' => 'nullable|array',
            'duration_unit' =>  'required|in:month,week,year|max:255',
            'duration_value' =>  'required|numeric|min:0',
            'status' =>  'required|integer|in:0,1|max:255',
            'is_officer' =>  'required|integer|in:0,1|max:255',
            'sort_by' =>  'required|numeric|min:0',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $model->where('id',$id)->update([
            'plan_name' => $request->plan_name,
            'price' => $request->price,
            'discount' => $request->discount,
            'short_desc' => $request->short_desc,
            'description' => json_encode($request->description,true) ?? [] ,
            'duration_unit' => $request->duration_unit,
            'duration_value' => $request->duration_value,
            'status' => $request->status,
            'is_officer' => $request->is_officer,
            'sort_by' => $request->sort_by,
            'created_at' => Carbon::now(),
            'updated_at' => NULL,
        ]);

        return response()->json([
            'message' => 'Record Updated Successfully',
            'data' => $model
        ],200);
        
    }

        public function show(Request $request,$id)
    {

        $model = MembershipPlan::find($id);
        if(!$model){
            return response()->json([
                'message' => 'Record Not Found',
            ], 422);
        }
        if (!empty($model->description)) {
            $model->description = json_decode($model->description, true);
        }
        
        return response()->json([
            'message' => 'Record Updated Successfully',
            'data' => $model
        ],200);

    }



    public function destroy($id)
    {

        $model = MembershipPlan::find($id);
        if(!$model){
            return response()->json(['message' =>'Record Not Found'], 422);
        }

        if(Membership::where('plan_id',$id)->first()){
            return response()->json(['message' =>'Cannot Delete Exist In User'], 422);
        }

        $model->delete();
        return response()->json(['message' =>'Record deleted successfully.'], 200);

    }


}
