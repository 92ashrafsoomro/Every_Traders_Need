<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GlobalSettingsController extends Controller
{
    // List all settings
    public function index()
    {
        $settings = Setting::all();
        return response()->json([
            'status' => true,
            'data' => $settings
        ]);
    }

    // Get single setting by id
    public function show($id)
    {
        $setting = Setting::find($id);
        if (!$setting) {
            return response()->json(['status' => false, 'message' => 'Setting not found'], 404);
        }
        return response()->json(['status' => true, 'data' => $setting]);
    }

    // Create new setting
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required|unique:settings,key',
            'value' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $setting = Setting::create($request->only('key', 'value'));

        return response()->json(['status' => true, 'data' => $setting, 'message' => 'Setting created successfully']);
    }

    // Update setting
    public function update(Request $request, $id)
    {
        $setting = Setting::find($id);
        if (!$setting) {
            return response()->json(['status' => false, 'message' => 'Setting not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'key' => 'required|unique:settings,key,' . $id,
            'value' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $setting->update($request->only('key', 'value'));

        return response()->json(['status' => true, 'data' => $setting, 'message' => 'Setting updated successfully']);
    }

    // Delete setting
    public function destroy($id)
    {
        $setting = Setting::find($id);
        if (!$setting) {
            return response()->json(['status' => false, 'message' => 'Setting not found'], 404);
        }

        $setting->delete();

        return response()->json(['status' => true, 'message' => 'Setting deleted successfully']);
    }
}