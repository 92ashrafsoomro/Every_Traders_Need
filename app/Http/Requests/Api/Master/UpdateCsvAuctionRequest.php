<?php

namespace App\Http\Requests\Api\Master;

use App\Models\AuctionCenter;
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
            'data.*.vehicle_id' => ['required',],
            'data.*.body_id'  => ['required',],
            'data.*.center_id' => ['required'],
            'data.*.make_id' => ['required',],
            'data.*.model_id' => ['required',],
            'data.*.variant_id' => ['nullable'],
            'data.*.last_bid' => ['nullable'],
            
        ];
    }

        public function withValidator(Validator $validator)
    {
            $validator->after(function ($validator) {

                $data = $this->input('data', []);
                foreach ($data as $index => $row) {
                                  
                    $VehicleType = VehicleType::whereRaw('TRIM(vehicle_type.name) = ?',[trim($row['vehicle_id'])])->first();
                    if ($VehicleType) {
                        $data[$index]['vehicle_id'] = $VehicleType->id;
                    }else{
                        $validator->errors()->add("data.$index.vehicle_id",'Type Invalid');
                    }

                    $BodyType = BodyType::whereRaw('TRIM(name) = ?',[trim($row['body_id'])])->first();
                    if ($BodyType) {
                        $data[$index]['body_id'] = $BodyType->id;
                    }else{
                        $validator->errors()->add("data.$index.body_id",'Body Invalid');
                    }

                    $Make = Make::whereRaw('TRIM(name) = ?',[trim($row['make_id'])])->first();
                    if ($Make) {
                        $data[$index]['make_id'] = $Make->id;
                    }else{
                        $validator->errors()->add("data.$index.make_id",'Make Invalid');
                    }

                    $VehicleModel = VehicleModel::whereRaw('TRIM(name) = ?',[trim($row['model_id'])])->first();
                    if ($VehicleModel) {

                        if($Make && $Make->id == $VehicleModel->make_id){
                            $data[$index]['model_id'] = $VehicleModel->id;
                        }else{
                            $validator->errors()->add("data.$index.model_id",'Model Invalid');
                        }

                    }else{
                        $validator->errors()->add("data.$index.model_id",'Model Invalid');
                    }
                    
                    
                    $ModelVariant = ModelVariant::where('name', $row['variant_id'])->first();
                    if ($ModelVariant) {

                        if($VehicleModel && $Make && $Make->id == $VehicleModel->make_id && $VehicleModel->id == $ModelVariant->model_id){
                            $data[$index]['variant_id'] = $ModelVariant->id;
                        }else{
                            $validator->errors()->add("data.$index.variant_id",'Variant Invalid');
                        }

                        
                    }else{
                         $validator->errors()->add("data.$index.variant_id",'Variant Invalid');
                    }

                    $AuctionCenter = AuctionCenter::where('name', $row['center_id'])->first();
                    if ($AuctionCenter) {
                        $data[$index]['center_id'] = $AuctionCenter->id;
                    }else{
                         $validator->errors()->add("data.$index.center_id",'Center Invalid');
                    }
                    
                }

                $this->merge([
                    'data' => $data
                ]);

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