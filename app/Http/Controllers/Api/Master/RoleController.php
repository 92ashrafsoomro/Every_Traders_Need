<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MembershipPlan;
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
            $length = $request->input('length',100);

            $query = Role::leftJoin('users','users.user_type','=','roles.id');
             

            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('roles.name', 'like', "%{$search}%");
                });
            }

            $count = (clone $query)->groupBy('users.user_type')->count('roles.id');

            $data = $query->select([
                        'roles.*',
                        DB::raw('COUNT(users.id) as users')
                    ])
                    ->groupBy(
                        'users.user_type',
                    )
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

        UserVehicleAlert::where('user_id',$id)->delete();
        UserPaymentMethod::where('user_id',$id)->delete();
        if(Membership::where('user_id',$id)->first()){
            return response()->json(["message" => "Cannot Delete Record Its Used In Membership"],400);
        }

        $model->delete();

        return response()->json([
            "message" => 'Record Deleted Successfully',
            "data" => $model,
        ],200);

    }





}
