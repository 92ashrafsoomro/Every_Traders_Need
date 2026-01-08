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
use App\Models\Prefix;
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
use Illuminate\Validation\Rule;

class PrefixController extends Controller
{

      public function index(Request $request)
    {

        $length = $request->input('length', 100);
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $length;

        //Query
        $query = Prefix::query();

        if($request->has('search') && $request->search != '') {
                $query->where('prefixes.name', 'like', '%'.$request->search.'%');
                $query->orWhere('prefixes.prefix_key', 'like', '%'.$request->search.'%');
                $query->orWhere('prefixes.prefix_value', 'like', '%'.$request->search.'%');
        }

        if($request->has('key') && $request->key != '') {
                $query->where('prefixes.prefix_key',$request->key);
        }

        if($request->has('value') && $request->value != '') {
                $query->where('prefixes.prefix_value',$request->value);
        }

        if($request->has('name') && $request->name != '') {
            $query->where('prefixes.name',$request->name);
        }


        if($request->has('search') && $request->search != '') {
                $query->where('prefixes.name', 'like', '%'.$request->search.'%');
                $query->orWhere('prefixes.prefix_key', 'like', '%'.$request->search.'%');
                $query->orWhere('prefixes.prefix_value', 'like', '%'.$request->search.'%');
        }

        $count = (clone $query)->count();
        $data = $query->select([
                    '*'
                ])
                ->skip($offset)
                ->take($length)
                ->orderByDesc('id')
                ->get();
            

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
            'key' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        Prefix::where(['name' => $request->name ,'prefix_key' => $request->key ])->delete();

        $model = Prefix::create([
            'name' => $request->name,
            'prefix_key' => $request->key,
            'prefix_value' => $request->value,
        ]);

        return response()->json([
            'message' => 'Record Created Successfully',
            'data' => $model
        ],200);

    }


    
    public function destroy(Request $request,$key)
    {

        $model = Prefix::where(['name' => $request->name,'prefix_key' => $key])->first();
        if(!$model){
            return response()->json([
                'message' => 'Record Not Found',
                'data' => $model
            ],400); 
        }

        $model->delete();

        return response()->json([
            'message' =>'Record deleted successfully.',
            'data' => $model,
        ], 200);

    }


}
