<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Package;
use App\Models\Role;
use App\Models\UserPaymentMethod;
use App\Models\UserVehicleAlert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    
    public function index(Request $request)
    {
            DB::statement("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

            $search = $request->input('search','');
            $offset  = $request->input('offset',0);
            $page  = $request->input('page',1);
            $length = $request->input('length',10);

            $query = Role::whereNotIn('id',[0,1]);
            
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('roles.name', 'like', "%{$search}%");
                });
            }

            $count = (clone $query)->count('roles.id');

            $data = $query->select([
                        'roles.*',
                    ])
                    ->offset($offset)
                    ->limit($length)
                    ->get()
                    ->map(function ($row) {
                        
                        return $row;
                    });


                return response()->json([
                    "total"  => $count,
                    'page' => $page,
                    'offset' => $offset,
                    'last_page' => ceil($count / $length),
                    'data' => $data,
                ],200);
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

        $data = Role::create(['name' => $request->name]); 
        return response()->json([
            'message' => 'Role Added',
            'data' => $data,
        ],200);
    }


    public function show($id)
    {

        $model = Role::find($id);
        if(!$model){
            return response()->json(["message" => "Record Not Found"],400);
        }

        return response()->json([
            "data" => $model,
        ],200);

    }


    public function update(Request $request, $id)
    {

        $model = Role::whereNotIn('id',[0,1])->where('id',$id)->first();
        if(!$model){
            return response()->json(["message" => "Record Not Found"],422);
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

        $model->name = $request->name;
        $model->save();
        
        return response()->json([
            "message" => 'Record Updated Successfully',
            "data" => $model,
        ],200);

    }


    public function destroy($id)
    {

        $model = Role::whereNotIn('id',[0,1])->where('id',$id)->first();
        if(!$model){
            return response()->json(["message" => "Record Not Found"],400);
        }

        if(User::where('user_type',$id)->first()){
            return response()->json(["message" => "Cannot Delete Record Its Used In Staff"],400);
        }

        $model->delete();

        return response()->json([
            "message" => 'Record Deleted Successfully',
            "data" => $model,
        ],200);

    }





}
