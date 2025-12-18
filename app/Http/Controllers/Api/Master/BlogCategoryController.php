<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\AuctionCenter;
use App\Models\BlogCategory;
use App\Models\Color;
use App\Models\Make;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Services\AuctionService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;


class BlogCategoryController extends Controller
{

      public function index(Request $request)
    {

        $length = $request->input('length', 50);
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $length;

        //Query
        $query = BlogCategory::query();

        //Filter
        if($request->has('id') && $request->id != '') {
            $query->where('id',$request->id);
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

            $model = BlogCategory::find($id);
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
            'title' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $model = BlogCategory::create([
            'title' => $request->title,
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

        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }


        $model = BlogCategory::find($id);
        if(!$model){
            return response()->json([
                'message' => 'Record Not Found',
            ], 422);
        }

        $model->where('id',$id)->update([
            'title' => $request->title,
            'updated_at' => Carbon::now(),
        ]);
             
        return response()->json([
            'message' => 'Record Updated Successfully',
            'data' => $model
        ],200);
        
    }


    public function destroy($id)
    {

        $model = BlogCategory::find($id);
        if(!$model){
            return response()->json(['message' => 'Record Not Found.'], 422);
        }

        $model->delete();
        return response()->json(['message' =>'Record deleted successfully.'], 200);

    }


}
