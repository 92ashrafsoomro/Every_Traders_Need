<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GlobalSettingsController extends Controller
{

    public function index()
    {
        $settings = Setting::all();
        return response()->json([
            'status' => true,
            'data' => $settings
        ]);
    }




    public function store(Request $request)
    {
        foreach ($request->all() as $key => $value) {

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );

        }

        return response()->json([
            'status' => true,
            'message' => 'Settings saved successfully'
        ]);
    }


}