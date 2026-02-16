<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;
use App\Mail\VerifyEmail;
use App\Models\UserDevice;

class ProfileController extends Controller
{

        public function profile(Request $request)
    {

        $user = $request->user();
        return response()->json([
            'message' => 'Get Profile Details',
            'data' => [
                'user' => new UserProfileResource($user),
            ],
        ]);

    }

    public function profileUpdate(Request $request)
    {
        $user = $request->id ? User::find($request->id) : $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'User not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'companyName' => 'required|string|max:255',
            'companyAddress1' => 'required|string|max:255',
            'companyAddress2' => 'required|string|max:255',
            'businessType' => 'required|string|max:255',
            'companyReg' => 'required|string|max:255',
            'townCity' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'website' => 'required|url',
            'postcode' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'businessEmail' => [
                'required','string','email','max:255',
                Rule::unique('users', 'businessEmail')->ignore($user->id)
            ],
            'motorTradeInsurance' => 'required|string|max:255',
            'vatNumber' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'jobTitle' => 'required|string|max:255',
            'source' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255',
            'personalEmail' => [
                'required','string','email','max:255',
                Rule::unique('users', 'personalEmail')->ignore($user->id)
            ],
            'password' => 'nullable|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        // Profile Company
        $user->companyName = $request->companyName;
        $user->companyAddress1 = $request->companyAddress1;
        $user->companyAddress2 = $request->companyAddress2;
        $user->businessType = $request->businessType;
        $user->companyReg = $request->companyReg;
        $user->website = $request->website;
        $user->businessEmail = $request->businessEmail;
        $user->motorTradeInsurance = $request->motorTradeInsurance;
        $user->vatNumber = $request->vatNumber;
        $user->townCity = $request->townCity;
        $user->country = $request->country;
        $user->postcode = $request->postcode;
        $user->telephone = $request->telephone;

        // Profile Personal
        $user->firstName = $request->firstName;
        $user->surname = $request->surname;
        $user->jobTitle = $request->jobTitle;
        $user->title = $request->jobTitle;
        $user->source = $request->source;
        $user->phone = $request->phone;

        // Handle file uploads (uploadID, avatar, proofs)
        if ($request->file('uploadID')) {
            if ($user->uploadID && file_exists(public_path('uploads/uploadID/' . $user->uploadID))) {
                unlink(public_path('uploads/uploadID/' . $user->uploadID));
            }
            $fileName = time() . '__ff__' . $request->file('uploadID')->getClientOriginalName();
            $request->file('uploadID')->move(public_path('uploads/uploadID'), $fileName);
            $user->uploadID = $fileName;
        }

        if ($request->file('avatar')) {
            if ($user->avatar && file_exists(public_path('uploads/avatar/' . $user->avatar))) {
                unlink(public_path('uploads/avatar/' . $user->avatar));
            }
            $fileName = time() . '__ff__' . $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move(public_path('uploads/avatar'), $fileName);
            $user->avatar = $fileName;
        }

        if ($request->file('motorTradeProof')) {
            if ($user->motorTradeProof && file_exists(public_path('uploads/motorTradeProof/' . $user->motorTradeProof))) {
                unlink(public_path('uploads/motorTradeProof/' . $user->motorTradeProof));
            }
            $fileName = time() . '__ff__' . $request->file('motorTradeProof')->getClientOriginalName();
            $request->file('motorTradeProof')->move(public_path('uploads/motorTradeProof'), $fileName);
            $user->motorTradeProof = $fileName;
        }

        if ($request->file('addressProof')) {
            if ($user->addressProof && file_exists(public_path('uploads/addressProof/' . $user->addressProof))) {
                unlink(public_path('uploads/addressProof/' . $user->addressProof));
            }
            $fileName = time() . '__ff__' . $request->file('addressProof')->getClientOriginalName();
            $request->file('addressProof')->move(public_path('uploads/addressProof'), $fileName);
            $user->addressProof = $fileName;
        }

        // Account
        $user->personalEmail = $request->personalEmail;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'message' => "Profile Updated Successfully",
            'data' => [
                'user' => new UserProfileResource($user),
            ],
        ], 200);
    }



       public function userDevices(Request $request)
    { 

        $perPage = (int) $request->input('length', 10);
        $page = (int) $request->input('page', 1);
        $offset = ($page - 1) * $perPage;
        $id = $request->user()->id;

        $query = UserDevice::query();
        // ->where('user_id', $id)
        // ->orderByDesc('logged_in_at');

        $total = (clone $query)->count();
        $totalNew = (clone $query)->count();
        $results = $query->select([
                '*'
            ])
            ->offset($offset)
            ->limit($perPage)
            
            ->get()
            ->map(function ($item) {

                $item->ago =  $item->created_at->diffForHumans();

            return $item;
        });

        return response()->json([
            'offset' => $offset,
            'total' => $total,
            'totalNew' => $totalNew,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => ceil($total / $perPage),
            'data' => $results,
        ]);

    }



    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:6|string',
            'new_password' => 'required|string|min:6|confirmed', // password_confirmation field required
        ]);

        $user = $request->user();

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password does not match'
            ], 422);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'message' => 'Password changed successfully'
        ], 200);
    }

  

    


}

