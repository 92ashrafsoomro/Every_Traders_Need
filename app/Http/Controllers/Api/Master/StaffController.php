<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MembershipPlan;
use App\Models\RecentView;
use App\Models\UserPaymentMethod;
use App\Models\UserVehicleAlert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{


    public function index(Request $request)
    {

        DB::statement("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $search = $request->input('search','');
        $offset  = $request->input('offset',0);
        $page  = $request->input('page',1);
        $length = $request->input('length',100);

        $query = User::query()
                ->whereNotIn('users.user_type',[0,1])
                ->leftJoin('roles','roles.id','=','users.user_type');
                  
        if(!empty($search)) {

            $query->where(function ($q) use ($search) {
                $q->where('users.firstName', 'like', "%{$search}%")
                ->orWhere('users.phone', 'like', "%{$search}%")
                ->orWhere('users.personalEmail', 'like', "%{$search}%");
            });
        }

        if($request->filled('status')) {
               $query->where('users.status', $request->status);
        }

        if($request->filled('id')) {
               $query->where('users.id', $request->id);
        }

        if($request->filled('type')) {
               $query->where('users.user_type', $request->type);
        }

 
        $count = (clone $query)->distinct('users.id')->count('users.id');

    
        $data = $query->select(
                    'users.id',
                    'users.firstName',
                    'users.personalEmail',
                    'users.phone',
                    'users.jobTitle',
                    'roles.name as role_name',
                    'users.user_type',
                    'users.status',      
                )
                ->groupBy('users.id')
                ->orderBy('users.created_at', 'desc')
                ->offset($offset)
                ->limit($length)
                ->get()
                ->map(function ($row) {
                    
                    // if ($row->membership_status === 'Expired' || empty($row->membership_status)) {
                    //     $row->membership_status = '<span>-</span>';
                    // } elseif (stripos($row->membership_status, 'Active') !== false) {
                    //     $row->membership_status = '<span class="badge btn btn-success btn-sm" style="color:white;">'.$row->membership_status.'</span>';
                    // } elseif (stripos($row->membership_status, 'Inactive') !== false) {
                    //     $row->membership_status = '<span class="badge bg-secondary" style="color:white;">'.$row->membership_status.'</span>';
                    // } elseif (stripos($row->membership_status, 'Pending') !== false) {
                    //     $row->membership_status = '<span class="badge bg-warning" style="color:white;">'.$row->membership_status.'</span>';
                    // } elseif (stripos($row->membership_status, 'Cancelled') !== false) {
                    //     $row->membership_status = '<span class="badge bg-primary" style="color:white;">'.$row->membership_status.'</span>';
                    // } else {
                    //     $row->membership_status = '<span class="badge bg-info text-dark" style="color:white;">' . e($row->membership_status) . '</span>';
                    // }
                    
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
            'firstName' => 'required|string|max:255',
            'personalEmail' => ['required','string','email','max:255',Rule::unique('users', 'personalEmail')],
            'user_type' => 'required|exists:roles,id|max:255',
            'jobTitle' => 'required|string|max:255',
            'status' => 'required|in:0,1|max:255',
            'password' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $model = User::create([
            'firstName' => $request->firstName,
            'personalEmail' => $request->personalEmail,
            'user_type' => $request->user_type,
            'jobTitle' => $request->jobTitle,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'created_at' => Carbon::now(),
            'updated_at' => NULL,
       
        ]);


        if ($request->file('avatar')) {
            if ($model->avatar && file_exists(public_path('uploads/avatar/' . $model->avatar))) {
                unlink(public_path('uploads/avatar/' . $model->avatar));
            }
            $fileName = time() . '__ff__' . $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move(public_path('uploads/avatar'), $fileName);
            $model->avatar = $fileName;
        }

        return response()->json([
            "message" => 'Record Created Successfully',
            "data" => $model,
        ],200);

      
    }


    public function show($id)
    {

        $model = User::find($id);
        if(!$model){
            return response()->json(["message" => "Record Not Found"],400);
        }

        return response()->json([
            "data" => $model,
        ],200);

    }



    public function update(Request $request, $id)
    {

        $model = User::find($id);
        if(!$model){
            return response()->json(["message" => "Record Not Found"],400);
        }
        
        $validator = Validator::make($request->all(),[
            'firstName' => 'required|string|max:255',
            'personalEmail' => ['required','string','email','max:255',Rule::unique('users', 'personalEmail')->ignore($model->id)],
            'user_type' => 'required|exists:roles,id|max:255',
            'jobTitle' => 'required|string|max:255',
            'status' => 'required|in:0,1|max:255',
            'password' => 'nullable|string|max:255',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $model->firstName = $request->firstName;
        $model->personalEmail = $request->personalEmail;
        $model->user_type = $request->user_type;
        $model->status = $request->status;
        $model->jobTitle = $request->jobTitle;

        if($request->password){
            $model->password = Hash::make($request->password);
        }
        
        $model->updated_at = Carbon::now();
       

        if ($request->file('avatar')) {
            if ($model->avatar && file_exists(public_path('uploads/avatar/' . $model->avatar))) {
                unlink(public_path('uploads/avatar/' . $model->avatar));
            }
            $fileName = time() . '__ff__' . $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move(public_path('uploads/avatar'), $fileName);
            $model->avatar = $fileName;
        }

        $model->save();

        return response()->json([
            "message" => 'Record Updated Successfully',
            "data" => $model,
        ],200);

    }


    public function destroy($id)
    {
        $model = User::find($id);
        if(!$model){
            return response()->json(["message" => "Record Not Found"],400);
        }

        if(Membership::where('user_id',$id)->first()){
            return response()->json(["message" => "Cannot Delete Record Its Used In Membership"],400);
        }

        DB::beginTransaction();
        try {

                UserVehicleAlert::where('user_id',$id)->delete();
                UserPaymentMethod::where('user_id',$id)->delete();
                RecentView::where('user_id',$id)->delete();
                $model->delete();

                DB::commit();
                return response()->json([
                    "message" => 'Record Deleted Successfully',
                    "data" => $model,
                ],200);
                
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
            ],500);
        }

        

    }


  



}
