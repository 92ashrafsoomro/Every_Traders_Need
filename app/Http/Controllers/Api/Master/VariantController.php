<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\AuctionCenter;
use App\Models\Color;
use App\Models\Make;
use App\Models\ModelVariant;
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


class VariantController extends Controller
{

      public function index(Request $request)
    {

        $length = $request->input('length', 50);
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $length;

        //Query
        $query = ModelVariant::leftJoin('model','model.id','=','model_variant.model_id')
        ->leftJoin('make','make.id','=','model.make_id');

        //Filter
        if($request->has('id') && $request->id != '') {
            $query->where('model_variant.id',$request->id);
        }

        if($request->has('make_id') && $request->make_id != '') {
            $query->where('model.make_id',$request->make_id);
        }

        if($request->has('model_id') && $request->model_id != '') {
            $query->where('model_variant.model_id',$request->model_id);
        }

        if($request->filled('name')){
            $query->whereRaw('LOWER(model_variant.name) = ?',[strtolower($request->name)]);
        }

        if($request->filled('search')) {
               $query->where('model_variant.name', 'like', '%'.$request->search.'%');
                $query->orWhere('model_variant.id', 'like', '%'.$request->search.'%');
        }

        $count = (clone $query)->count();
        $data = $query->select([
                    'model_variant.*',
                    'make.name as makeName',
                    'make.id as makeId',
                    'model.name as modelName',
                    'model.id as modelId',
                ])
                ->skip($offset)
                ->take($length)
                ->orderByDesc('id')
                ->get()
                ->map(function($item){

                     $item->full = $item->makeName.'-'.$item->modelName.'-'.$item->name;

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
            'model_id' => 'required|exists:model,id|max:255',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $model = ModelVariant::create([
            'name' => $request->name,
            'model_id' => $request->model_id,
            'created_at' => Carbon::now(),
            'updated_at' => NULL,
        ]);

        return response()->json([
            'message' => 'Record Created Successfully',
            'data' => $model
        ],200);

    }

         public function show(Request $request,$id)
    {

            $model = ModelVariant::find($id);
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


       public function update(Request $request,$id)
    {

        $model = ModelVariant::find($id);
        if(!$model){
            return response()->json([
                'message' => 'Record Not Found',
            ], 422);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'model_id' => 'required|exists:model,id|max:255',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $model->where('id',$id)->update([
            'name' => $request->name,
            'model_id' => $request->model_id,
            'updated_at' => Carbon::now(),
        ]);

        return response()->json([
            'message' => 'Record Updated Successfully',
            'data' => $model
        ],200);
        
    }



    public function destroy($id)
    {

        $model = ModelVariant::find($id);
        if(!$model){
            return response()->json(['message' =>'Record Not Found'], 422);
        }

        if(Vehicle::where('variant_id',$id)->first()){
            return response()->json(['message' =>'Cannot Delete Exist In Vehicle'], 422);
        }

        $model->delete();
        return response()->json(['message' =>'Record deleted successfully.'], 200);

    }


}
