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


class CenterController extends Controller
{

      public function index(Request $request)
    {

        $length = $request->input('length', 50);
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $length;

        //Query
        $query = AuctionCenter::query();

        //Filter
        if($request->has('id') && $request->id != '') {
            $query->where('auction_center.id',$request->id);
        }

        $count = (clone $query)->count();
        $data = $query->select([
                    '*'
                ])
                ->skip($offset)
                ->take($length)
                ->orderByDesc('id')
                ->get()
                ->map(function($item){
                    if($item->image){
                    $item->image = asset('/uploads/'.$item->image);
                    }

            
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

      public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $model = AuctionCenter::create([
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


        $model = AuctionCenter::find($id);
        if(!$model){
            return response()->json([
                'message' => 'Record Not Found',
            ], 422);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        AuctionCenter::where('id',$id)->update([
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => NULL,
        ]);


        $model = AuctionCenter::find($id);
        
        return response()->json([
            'message' => 'Record Updated Successfully',
            'data' => $model
        ],200);
        
    }


    public function destroy($id)
    {

        $model = AuctionCenter::find($id);
        if(!$model){
            return response()->json(['message' =>'Record Not Found'], 422);
        }

        if(Vehicle::where('center_id',$id)->first()){
            return response()->json(['message' =>'Cannot Delete Exist In Vehicle'], 422);
        }

        $model->delete();
        return response()->json(['message' =>'Record deleted successfully.'], 200);

    }


}
