<?php

namespace App\Http\Requests\Api\Master;

use App\Models\BodyType;
use App\Models\Make;
use App\Models\ModelVariant;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\DB;

class UpdateCsvAuctionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array|min:1',
            'data.*.vehicle_id' => [
                'required',
            ],
            'data.*.body_id'  => ['required',],
            'data.*.center_id' => ['required'],
            'data.*.make_id' => ['required',],
            'data.*.model_id' => ['required',],
            'data.*.variant_id' => ['required'],
            
        ];
    }

        public function withValidator(Validator $validator)
    {
            $validator->after(function ($validator) {


                foreach ($this->input('data', []) as $index => $row) {
                    
                    // dd(trim($row['vehicle_id']));
                    if (!VehicleType::whereRaw('TRIM(vehicle_type.name) = ?',[trim($row['vehicle_id'])])->exists()) {
                        $validator->errors()->add(
                            "data.$index.vehicle_id",
                            'is invalid'
                        );
                    }

                    if (!BodyType::whereRaw('TRIM(name) = ?',[trim($row['body_id'])])->exists()) {
                        $validator->errors()->add(
                            "data.$index.body_id",
                            'is invalid'
                        );
                    }

                    if (!Make::whereRaw('TRIM(name) = ?',[trim($row['make_id'])])->exists()) {
                        $validator->errors()->add(
                            "data.$index.make_id",
                            'is invalid'
                        );
                    }

                    
                    if (!VehicleModel::whereRaw('TRIM(name) = ?',[trim($row['model_id'])])->exists()) {
                        $validator->errors()->add(
                            "data.$index.model_id",
                            'is invalid'
                        );
                    }
                    

                        
                    if (!ModelVariant::where('name', $row['variant_id'])->exists()) {
                        $validator->errors()->add(
                            "data.$index.variant_id",
                            'is invalid'
                        );
                    }
                    



                }

            });
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {

        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422)
        );

    }

}