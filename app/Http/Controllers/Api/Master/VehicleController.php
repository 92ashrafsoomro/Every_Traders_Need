<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\AuctionCenter;
use App\Models\AuctionPlatform;
use App\Models\Auctions;
use App\Models\BodyType;
use App\Models\Color;
use App\Models\Interest;
use App\Models\Make;
use App\Models\ModelVariant;
use App\Models\Notification;
use App\Models\RecentView;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Services\AuctionService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;


class VehicleController extends Controller
{

      public function index(Request $request)
    {

        $length = $request->input('length', 50);
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $length;

        //Query
        $query = Vehicle::leftJoin('auction_center', 'auction_center.id', '=', 'vehicles.center_id')
            ->leftJoin('auctions', 'auctions.id', '=', 'vehicles.auction_id')
            ->leftJoin('make', 'make.id', '=', 'vehicles.make_id')
            ->leftJoin('model', 'model.id', '=', 'vehicles.model_id')
            ->leftJoin('model_variant', 'model_variant.id', '=', 'vehicles.variant_id')
            ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'vehicles.vehicle_id')
            ->leftJoin('body_types', 'body_types.id', '=', 'vehicles.body_id');


        //Filter
        if($request->has('id') && $request->id != '') {
            $query->where('vehicles.id',$request->id);
        }

        if($request->filled('search')) {
                $query->where('make.name', 'like', '%'.$request->search.'%');
                $query->orWhere('vehicles.id', 'like', '%'.$request->search.'%');
        }
        if ($request->filled('make')) {
            $query->where('vehicles.make_id', $request->make);
        }

        if ($request->filled('model')) {
            $query->where('vehicles.model_id', $request->model);
        }

        if ($request->filled('variant')) {
            $query->where('vehicles.variant_id', $request->variant);
        }
        if ($request->filled('platform')) {
            $query->where('vehicles.auction_id', $request->platform);
        }
        if ($request->filled('center')) {
            $query->where('auction_center.id', $request->center);
        }
        if ($request->filled('vehicleType')) {
            $query->where('auctions.auction_type', $request->vehicleType);
        }
        if ($request->filled('registration')) {
            $query->where('vehicles.reg', $request->registration);
        }
        if($request->filled("tableid")){
            $query->where('auctions.table_id',$request->tableid);
        }
        $count = (clone $query)->count();
        $data = $query->select([
                'vehicles.*',
                'auction_center.name as center_name',
                'make.name as make_name',
                'model.name as model_name',
                'model_variant.name as variant_name',
                'vehicle_type.name as vehicle_name',
                'body_types.name as body_name',
                
            ])
            ->skip($offset)
            ->take($length)
            ->orderByDesc('id')
            ->get()
            ->map(function($item){

                $item->date = Carbon::parse($item->created_at)->format('Y-m-d');

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

         public function show(Request $request,$id)
    {

            $model = VehicleType::find($id);
            if(!$model){
                return response()->json([
                    'message' => 'Record Not Found',
                ], 422);
            }

        
            return response()->json([
                'message' => 'Record Updated Successfully',
                'data' => $model
            ],200);

        
    }

    
      public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
        ]);

         if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $model = VehicleType::create([
            'name' => $request->name,
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

        $model = VehicleType::find($id);
        if(!$model){
            return response()->json([
                'message' => 'Record Not Found',
            ], 422);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
        ]);
         if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

       $model = VehicleType::where('id',$id)->update([
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => NULL,
        ]);

        return response()->json([
            'message' => 'Record Updated Successfully',
            'data' => VehicleType::find($id)
        ],200);

    }


    public function destroy($id)
    {

        $model = VehicleType::findOrFail($id);
        if(Vehicle::where('body_id',$id)->first()){
            return response()->json(['message' =>'Cannot Delete Exist In Vehicle'], 422);
        }

        $model->delete();
        return response()->json(['message' =>'BodyType deleted successfully.'], 200);

    }


}
