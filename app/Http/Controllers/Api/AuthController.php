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
use App\Models\Membership;
use App\Models\Role;

    class AuthController extends Controller
{

    
        public function profile(Request $request)
    {

        $user = $request->user();
        $role = Role::find($user->user_type);
        $current = Membership::where('user_id',$user->id)
        ->with(['plan'])
        ->where('membership_status',1)
        ->whereDate('membership_start_date', '<=', now())
        ->whereDate('membership_expiry_date', '>=', now())
        ->first();

        return response()->json([
            'message' => 'Get Profile Details',
            'data' => [
                'id'                => $user->id,
                'firstName'         => $user->firstName,
                'role'              => $role ? $role->name : 'User',
                'status'            => $user->status,
                'avatar'            => $user->avatar ? env('APP_URL') . 'public/uploads/avatar/' . $user->avatar: null,
                'jobTitle'          => $user->jobTitle,
                'personalEmail'     => $user->personalEmail,
                'plan'              =>  $current,
            ],
        ]);

    }


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(),
        [
            "email" => 'required|string',
            "password" => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Find the user with personalEmail and user_type = 0
        $user = User::where('personalEmail', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found or not authorized.',], 422);
        }

        if ($user->email_verification_token_status == 0) {
            if ($user->email_verification_token == NULL){
                try {
                    $user->email_verification_token = strtoupper(Str::random(6));
                    $user->save();
            
                    Mail::to($user->personalEmail)->send(new VerifyEmail($user));
                    return response()->json(['message' => 'user verification send You Email',], 422);
                } catch (\Exception $e) {
                    \Log::error('Email sending failed: ' . $e->getMessage());
                }
            }else{

                return response()->json(['message' => 'This user verification not be done',], 422);
            }

        }

        if ($user->status == 0) {
            return response()->json(['message' => 'Your account is deactivated or blocked. Please contact support.',], 422);
        }


        if (Hash::check($request->password, $user->password)) {
                // Create token
                $token = $user->createToken('autoboli_token')->plainTextToken;
                return response()->json([
                    'message' => 'Login Success',
                    'data' =>[
                        'user' => new UserProfileResource($user),
                        'token' => $token
                    ],
                ]);
        }

        return response()->json([
            'message' => 'Login Request Failed Contact To Support',
        ],422);

    }





     public function register(Request $request)
    {   
        $validator = Validator::make($request->all(),[
                'companyName' => 'required|string|max:255',
                'companyAddress1' => 'required|string|max:255',
                'companyAddress2' => 'required|string|max:255',
                'businessType' => 'required|string|max:255',
                'companyReg' => 'required|string|max:255',
                'townCity' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                // 'website' => 'required|url',
                'postcode' => 'required|string|max:255',
                'telephone' => 'required|string|max:255',
                // 'businessEmail' => 'required|string|email|max:255|unique:users',
                'motorTradeInsurance' => 'required|string|max:255',
                // 'vatNumber' => 'required|string|max:255',

                'firstName' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'jobTitle' => 'required|string|max:255',
                'source' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'avatar' => 'required|file|mimes:jpg,png,pdf|max:4096',

                'motorTradeProof' => 'nullable|file|mimes:jpg,png,pdf|max:4096',
                'addressProof' => 'nullable|file|mimes:jpg,png,pdf|max:4096',

                'personalEmail' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string',
            ],
            [],
            [
                'companyName' => 'Company Name',
                'companyAddress1' => 'Address Line 1',
                'companyAddress2' => 'Address Line 2',
                'townCity' => 'Town or City',
                'country' => 'Country',
                'postcode' => 'Postcode',
                'telephone' => 'Telephone Number',
                'businessType' => 'Business Type',
                'companyReg' => 'Company Registration Number',
                'website' => 'Company Website',
                'businessEmail' => 'Business Email',
                'motorTradeInsurance' => 'Motor Trade Insurance',
                'vatNumber' => 'VAT Number',
                'firstName' => 'First Name',
                'surname' => 'Surname',
                'jobTitle' => 'Job Title',
                'password' => 'Password',
                'phone' => 'Phone Number',
                'personalEmail' => 'Personal Email',
                'password' => 'Password',
                'uploadID' => 'Upload ID',
                'motorTradeProof' => 'Motor Trade Proof',
                'addressProof' => 'Address Proof',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        // dd($request->all());


        //Profile Company
        $user = new User();
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
        

        //Profile
        $user->firstName = $request->firstName;
        $user->surname = $request->surname;
        $user->jobTitle = $request->jobTitle;
        $user->title = $request->jobTitle;
        $user->source = $request->source;
        $user->phone = $request->phone;
        if ($request->file('avatar')) {
            // Remove existing thumbnail if it exists
            if ($user->avatar && file_exists(public_path('uploads/' . $user->avatar))) {
                unlink(public_path('uploads/' . $user->avatar));
            }
            $fileName = time() . '__ff__' . $request->file('avatar')->getClientOriginalName();
            $filePath = public_path('uploads/avatar');
            $request->file('avatar')->move($filePath, $fileName);
            $user->avatar = $fileName;
        }

        //License
        if ($request->file('motorTradeProof')) {
            // Remove existing thumbnail if it exists
            if ($user->motorTradeProof && file_exists(public_path('uploads/' . $user->motorTradeProof))) {
                unlink(public_path('uploads/' . $user->motorTradeProof));
            }
            $fileName = time() . '__ff__' . $request->file('motorTradeProof')->getClientOriginalName();
            $filePath = public_path('uploads/motorTradeProof');
            $request->file('motorTradeProof')->move($filePath, $fileName);
            $user->motorTradeProof = $fileName;
        }

        if ($request->file('addressProof')) {
            // Remove existing thumbnail if it exists
            if ($user->addressProof && file_exists(public_path('uploads/' . $user->addressProof))) {
                unlink(public_path('uploads/' . $user->addressProof));
            }
            $fileName = time() . '__ff__' . $request->file('addressProof')->getClientOriginalName();
            $filePath = public_path('uploads/addressProof');
            $request->file('addressProof')->move($filePath, $fileName);
            $user->addressProof = $fileName;
        }

        //Account
        $user->personalEmail = $request->personalEmail;
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        
        $user->email_verification_token = strtoupper(Str::random(6));
        $user->email_verification_token_status = 0;
        $user->status = 1;
        $user->user_type = 0;
        $user->save();

        try {
            Mail::to($user->personalEmail)->send(new VerifyEmail($user));
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
        }


        $token = $user->createToken('autoboli_token')->plainTextToken;   
        return response()->json([
            'message' => "Send verification link Your Email",
            // 'data' =>[
            //     'user' => new UserProfileResource($user),
            //     'token' => $token
            // ],  
        ],200);



   
        // if ($request->plan_id == 2) {

        //     $user = $this->AccountCreate($request);
        //     $transactionId = "00";
        //     $this->planCreate($user, $transactionId, $plan, $request);
        //     Auth::login($user);

        //     return response()->json([
        //         'message' => 'Registration Successful.',
        //     ], 201);
        // } else {

        //     $validator = Validator::make($request->all(), [
        //         'payment_method' => 'required|string',
        //     ]);

        //     if ($validator->fails()) {
        //         return response()->json([
        //             'message' => 'Request Failed',
        //             'errors' => $validator->errors()
        //         ], 422);
        //     }
        // }




        //Stripe Process

        // Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // try {

        //     $intent = PaymentIntent::create([
        //         'amount' => round($plan->price * 100),
        //         'currency' => 'gbp',
        //         'automatic_payment_methods' => [
        //             'enabled' => true,
        //             'allow_redirects' => 'never',
        //         ],
        //         'confirm' => true,
        //         'payment_method' => $request->payment_method
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         "message" => $e->getMessage(),
        //     ], 500);
        // }


        // if ($intent->status == 'succeeded') {

        //     $user = $this->AccountCreate($request);
        //     $transactionId = $intent->latest_charge;
        //     $this->planCreate($user, $transactionId, $plan, $request);
        //     Auth::login($user);

        //     return response()->json([
        //         'message' => 'Registration and payment successful.',
        //     ], 201);
        // } elseif ($intent->status == 'requires_action' && $intent->next_action->type == 'use_stripe_sdk') {

        //     return response()->json([
        //         "message" => "Additional authentication is required (e.g. 3D Secure).",
        //     ], 500);
        // } else {

        //     $errorMessage = $intent->last_payment_error->message ?? 'Payment failed or incomplete.';
        //     return response()->json([
        //         'message' => $errorMessage,
        //         'status' => $intent->status,
        //     ], 500);
        // }


    }

    
    

    public function forgotPassword(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Invalid email format.',
                        'errors' => $validator->errors()
                    ], 422);
            }

            $email = $request->email;
            $userExists = DB::table('users')->where('personalEmail', $email)->exists();

            if (!$userExists) {
                return response()->json([
                    'status' => false,
                    'message' => $email . ' This email address is not registered in our system.'
                ], 404);
            }


            $token = Str::random(64);

            try {
                DB::table('password_reset_tokens')->where('email', $email)->delete();
                DB::table('password_reset_tokens')->insert([
                    'email' => $email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
                $resetLink = url('/resetpassword?token=' . $token );
                Mail::to($email)->send(new PasswordResetMail($resetLink));

                return response()->json([
                    'status' => true,
                    'message' => 'Password reset link has been sent to your email.'
                ], 200);

            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to send reset link. Please try again later.',
                    'error' => $e->getMessage()
                ], 500);
            }
    }


    public function resetPasswordSubmit(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }

        $token = $request->token;
        $tokenData = DB::table('password_reset_tokens')->where('token', $token)->first();

        if (!$tokenData) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or expired token.'
            ], 404);
        }
        $user = User::where('personalEmail', $tokenData->email)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found.'
            ], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();
        DB::table('password_reset_tokens')->where('email', $tokenData->email)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Password reset successfully!'
        ], 200);
    }


        public function verifyEmail(Request $request)
    {

        $user = User::where('personalEmail', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        }

        if ($user->status == 0) {
            if (!$user->last_resend_at || !Carbon::parse($user->last_resend_at)->addHours(24)->isPast()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your account is blocked. Please try again after 24 hours.'
                ], 403);
            }

            // unblock
            $user->status = 1;
            $user->resend_count = 0;
            $user->save();
        }

        if ($user->email_verification_token !== $request->token) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid verification code.'
            ], 422);
        }

        // ✅ verified
        $user->email_verification_token = null;
        $user->email_verification_token_status = 1;
        $user->save();

        $token = $user->createToken('autoboli_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Email verified successfully.',
            'data' => [
                'user' => new UserProfileResource($user),
                'token' => $token
            ]
        ], 200);
    }




}

