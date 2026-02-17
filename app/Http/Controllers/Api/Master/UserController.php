<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Package;
use App\Models\RecentView;
use App\Models\UserPaymentMethod;
use App\Models\UserVehicleAlert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index(Request $request)
    {

        DB::statement("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $search = $request->input('search','');
        $offset  = $request->input('offset',0);
        $page  = $request->input('page',1);
        $length = $request->input('length',100);

        $query = User::whereIn('users.user_type',[0])
                    ->leftJoin('roles','roles.id','=','users.user_type')
                   
                    ->leftJoin('memberships', function ($join) {
                        $join->on('memberships.user_id', '=', 'users.id')
                            ->where('memberships.membership_status', '=', 1);
                    })
                    ->leftJoin('plans','plans.id','=','memberships.plan_id');

                    // ->leftJoin('memberships', function($join) {
                    //     $join->on('memberships.user_id', '=', 'users.id')
                    //     ->whereRaw('memberships.id = (SELECT id FROM memberships m2 WHERE m2.user_id = users.id ORDER BY m2.created_at DESC LIMIT 1)');
                    // });


        if(!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('users.surname', 'like', "%{$search}%")
                ->orWhere('users.id', 'like', "%{$search}%")
                ->orWhere('users.firstName', 'like', "%{$search}%")
                ->orWhere('users.companyName', 'like', "%{$search}%")
                ->orWhere('users.phone', 'like', "%{$search}%")
                ->orWhere('users.personalEmail', 'like', "%{$search}%")
                ->orWhere('users.businessType', 'like', "%{$search}%");
            });
        }

        if($request->filled('plan_id')) {
            $query->where('memberships.plan_id',$request->plan_id);
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

        // if ($request->has('plan_id') && $request->plan_id !== '') {
        //     $query->where('membership_plans.id', $request->plan_id);
        // }

        // if ($request->status !== null && $request->status !== '') {
        //     $query->where('users.status', $request->status);
        // }

        // if ($request->user_type !== null && $request->user_type !== '') {
        //     $query->where('users.user_type', $request->user_type);
        // }

            $count = (clone $query)->distinct('users.id')->count('users.id');
            $data = $query->select(
                        'users.id',
                        'users.firstName',
                        'users.phone',
                        'users.businessType',
                        'roles.name as role_name',
                        'users.surname',
                        'users.companyName',
                        'users.user_type',
                        'users.status',
                        'users.email_verification_token_status',
                        'users.personalEmail',
                        DB::raw('COUNT(memberships.id) as memberships'),

                        
                        //Membership
                        'plans.id as plan_id',
                        'plans.plan_name',
                        'memberships.package_name as package_name',
                        'memberships.package_description',
                        'memberships.price as package_price',
                        'memberships.discount as package_discount',
                        'memberships.total as package_total',
                        'memberships.membership_start_date as package_membership_start_date',
                        'memberships.membership_expiry_date as package_membership_expiry_date',
                        'memberships.membership_status as package_membership_status',        
                    )
                    ->groupBy('users.id')
                    ->orderBy('users.created_at', 'desc')
                    // ->offset($offset)
                    // ->limit($length)
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




                    $planCounts = DB::table('plans')
                    ->leftJoin('memberships', 'memberships.plan_id', '=', 'plans.id')
                    ->select(
                        'plans.id',
                        'plans.plan_name',
                        DB::raw('COUNT(memberships.user_id) as total_users')
                    )
                    ->groupBy('plans.id','plans.plan_name')
                    ->get();


                    return response()->json([
                        "total"  => $count,
                        'page' => $page,
                        'offset' => $offset,
                        'last_page' => ceil($count / $length),
                        'data' => $data,
                        'planCounts'=>$planCounts
                    ],200);
    }


     public function store(Request $request)
    {
        dd($request->all());   
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
        

        $validations = [
            'businessEmail' => 'required|email',
            'personalEmail' => 'required|email',
            'password' => 'nullable|string',
            'avatar' => 'nullable|file',
            'uploadID' => 'nullable|file',
            'motorTradeProof' => 'nullable|file',
            'addressProof' => 'nullable|file',
        ];

        $request->validate($validations);

        $model->companyName = $request->companyName;
        $model->businessType = $request->businessType;
        $model->companyReg = $request->companyReg;
        $model->website = $request->website;
        $model->businessEmail = $request->businessEmail;
        $model->motorTradeInsurance = $request->motorTradeInsurance;
        $model->vatNumber = $request->vatNumber;
        $model->companyAddress1 = $request->companyAddress1;
        $model->companyAddress2 = $request->companyAddress2;
        $model->townCity = $request->townCity;
        $model->country = $request->country;
        $model->postcode = $request->postcode;
        $model->telephone = $request->telephone;
        
        $model->firstName = $request->firstName;
        $model->surname = $request->surname;
       
        $model->title = $request->title;
        $model->jobTitle = $request->jobTitle;
        $model->phone = $request->phone;
        $model->personalEmail = $request->personalEmail;
        $model->status = $request->status;
        $model->user_type = 0;


        if ($request->password) {
            $model->password = Hash::make($request->password);
        }

        if ($request->file('avatar')) {
            // Remove existing thumbnail if it exists
            if ($model->avatar && file_exists(public_path('uploads/' . $model->avatar))) {
                unlink(public_path('uploads/' . $model->avatar));
            }
            $fileName = time() . '__ff__' . $request->file('avatar')->getClientOriginalName();
            $filePath = public_path('uploads/avatar');
            $request->file('avatar')->move($filePath, $fileName);
            $model->avatar = $fileName;
            // $user->save();
        }

        if ($request->file('uploadID')) {
            // Remove existing thumbnail if it exists
            if ($model->uploadID && file_exists(public_path('uploads/' . $model->uploadID))) {
                unlink(public_path('uploads/' . $model->uploadID));
            }
            $fileName = time() . '__ff__' . $request->file('uploadID')->getClientOriginalName();
            $filePath = public_path('uploads/uploadID');
            $request->file('uploadID')->move($filePath, $fileName);
            $model->uploadID = $fileName;
            // $user->save();
        }

        if ($request->file('motorTradeProof')) {
            // Remove existing thumbnail if it exists
            if ($model->motorTradeProof && file_exists(public_path('uploads/' . $model->motorTradeProof))) {
                unlink(public_path('uploads/' . $model->motorTradeProof));
            }
            $fileName = time() . '__ff__' . $request->file('motorTradeProof')->getClientOriginalName();
            $filePath = public_path('uploads/motorTradeProof');
            $request->file('motorTradeProof')->move($filePath, $fileName);
            $model->motorTradeProof = $fileName;
            // $user->save();
        }

        if ($request->file('addressProof')) {
            // Remove existing thumbnail if it exists
            if ($model->addressProof && file_exists(public_path('uploads/' . $model->addressProof))) {
                unlink(public_path('uploads/' . $model->addressProof));
            }
            $fileName = time() . '__ff__' . $request->file('addressProof')->getClientOriginalName();
            $filePath = public_path('uploads/addressProof');
            $request->file('addressProof')->move($filePath, $fileName);
            $model->addressProof = $fileName;
            // $user->save();
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


    public function changeStatus(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'user_id' => 'required|exists:users,id|max:255',
            'status' => 'required|max:255',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }
    
        $model = User::find($request->user_id);
        $model->status = $request->status;
        $model->save();

        return response()->json([
            "message" => 'Status Changed Successfully',
            "data" => $model,
        ],200);
        
    }




}
