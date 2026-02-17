<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\MembershipPayment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Package;
use App\Models\Plan;
use App\Models\UserPaymentMethod;
use App\Models\UserVehicleAlert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class MembershipController extends Controller
{

    public function index(Request $request)
    {

        DB::statement("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $search = $request->input('search','');
        $offset  = $request->input('offset',0);
        $page  = $request->input('page',1);
        $length = $request->input('length',100);

        $query = Membership::query()
                    ->leftJoin('users','users.id','=','memberships.user_id')
                    ->leftJoin('plans', 'plans.id', '=', 'memberships.plan_id')
                    ->leftJoin('roles','roles.id','=','users.user_type');
                    
        if(!empty($search)) {

            $query->where(function ($q) use ($search) {
                $q->where('users.surname', 'like', "%{$search}%")
                ->orWhere('users.firstName', 'like', "%{$search}%")
                ->orWhere('users.companyName', 'like', "%{$search}%")
                ->orWhere('users.phone', 'like', "%{$search}%")
                ->orWhere('users.personalEmail', 'like', "%{$search}%")
                ->orWhere('users.businessType', 'like', "%{$search}%")
                ->orWhere('plans.plan_name', 'like', "%{$search}%");
            });
        }

        if ($request->has('plan_id') && $request->plan_id !== '') {
            $query->where('plans.id', $request->plan_id);
        }

        if ($request->status !== null && $request->status !== '') {
            $query->where('memberships.membership_status', $request->status);
        }
        if ($request->has('year') && $request->year !== '') {
            $query->whereYear('memberships.membership_expiry_date', $request->year);
        }

        if ($request->has('month') && $request->month !== '') {
            $query->whereMonth('memberships.membership_expiry_date', $request->month);
        }

        // if ($request->user_type !== null && $request->user_type !== '') {
        //     $query->where('users.user_type', $request->user_type);
        // }

            $count = (clone $query)->count('users.id');

            $data = $query->select(
                        'memberships.*',
                        'users.firstName',
                        'plans.plan_name',
                         DB::raw("COALESCE(plans.plan_name, 'No Plan Purchased') as plan"),
                        'users.phone',
                        'users.businessType',
                        'roles.name as role_name',
                        'users.surname',
                        'users.companyName',
                        'users.user_type',
                        'memberships.membership_status',
                        'memberships.membership_expiry_date',
                        'users.personalEmail',
                    )
                    
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
            'user_id' => 'required|exists:users,id|max:255',
            'package_id' => 'required|exists:packages,id|max:255',
            'membership_status' =>  'required|numeric|min:0',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }


        $package = Package::find($request->package_id);     
        $user = User::find($request->user_id);

        $start_date = now();
        if ($package->duration_unit === 'month') {
            $expiry_date = now()->addMonth();
        } elseif ($package->duration_unit === 'year') {
            $expiry_date = now()->addYear();
        } else {
            $start_date = $request->start_date;
            $expiry_date = $request->end_date;
        }

        $total = intval($package->price) + intval($package->discount);

        // dd($package->plan_id);

        $membership = Membership::create([
            'user_id' => $user->id,
            'plan_id' => $package->plan_id,
            'package_name' => $package->title,
            'package_description' => $package->package_description,
            'price' => $package->price,
            'discount' => $package->discount,
            'total' => $total,
            'membership_start_date' => $start_date,
            'membership_expiry_date' => $expiry_date,
            'membership_status' => 1,
            'created_at' => Carbon::now(),
        ]);

        // MembershipPayment::create([
        //     'user_id' => $user->id,
        //     'membership_id' => $membership->id,
        //     'plan_id' => $plan->id,
        //     'payment_date' => now(),
        //     'payment_method' => $request->payment_method,
        //     'transaction_id' => $request->transaction_id ?? '',
        //     'payer_id' => $request->payer_id ?? '',
        //     'charge_id' => $request->charge_id ?? '',
        //     'amount' => $request->amount,
        //     'currency' => $request->currency,
        //     'membership_status' => $request->membership_status,
        // ]);

        return response()->json([
            'message' => 'Record Created Successfully',
            'data' => $membership
        ],200);

      
    }


    public function show($id)
    {

        $model = Membership::where('id',$id)->first();
        if(!$model){
            return response()->json(["message" => "Record Not Found"],400);
        }

        $model->plan = Plan::where('id',$model->plan_id)->first();
        $model->user = User::where('id',$model->user_id)->first();

        return response()->json([
            "data" => $model,
        ],200);

    }


    public function update(Request $request, $id)
    {


        // $model = Membership::find($id);
        // if(!$model){
        //     return response()->json(["message" => "Record Not Found"],400);
        // }
        
        // $validator = Validator::make($request->all(),[
        //     'membership_status' => 'required|string|max:100',
        // ]);
        // if($validator->fails()) {
        //     return response()->json([
        //         'message' => $validator->errors()->first(),
        //         'errors' => $validator->errors()
        //     ], 422);
        // }

        // $model->membership_status = $request->membership_status;
        // $model->save();
        
        // return response()->json([
        //     "message" => 'Record Updated Successfully',
        //     "data" => $model,
        // ],200);

        
    }


    public function destroy($id)
    {

        $model = Membership::find($id);
        if(!$model){
            return response()->json(["message" => "Record Not Found"],400);
        }

        $model->delete();

        return response()->json([
            "message" => 'Record Deleted Successfully',
            "data" => $model,
        ],200);

    }



}
