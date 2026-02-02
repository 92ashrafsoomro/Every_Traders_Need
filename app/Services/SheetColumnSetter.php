<?php

namespace App\Services;

use App\Models\AuctionCenter;
use App\Models\Auctions;
use App\Models\BodyType;
use App\Models\Prefix;
use App\Models\Interest;
use App\Models\Make;
use App\Models\Membership;
use App\Models\MembershipPayment;
use App\Models\ModelVariant;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class SheetColumnSetter 
{
    
    protected $item;
    public $prefixes;
    public $platformId;
    public $make;
    public $model;

    function __construct($item) {
        $this->item = $item;
        $this->item['errors'] = [];
        $this->make = null;
        $this->model = null;
    }


    public function setBodyId()
    {   
        $prefixes = $this->prefixes['bodyType'];
        $value = strtolower($this->item['body_id']);

        // if($value == 'platform cab'){
        //     dd($prefixes);
        //     dd(isset($prefixes[$value]));
        // }

        $value = isset($prefixes[$value]) ? $prefixes[$value] : $value;
        $this->item['body_id'] = $value;
    }

    public function setVehicleId()
    {
        $prefixes = $this->prefixes['vehicleType'];
        $value = strtolower($this->item['body_id']);
        $value = isset($prefixes[$value]) ? $prefixes[$value] : $value;
        $this->item['vehicle_id'] = $value;

    }



      public function setMakeId()
    {
        $prefixes = $this->prefixes['make'];
        $value = strtolower($this->item['make_id']);
        $value = isset($prefixes[$value]) ? $prefixes[$value] : $value;
        $this->item['make_id'] = $value;

        $make  = Make::whereRaw('LOWER(name) = ?', [strtolower($this->item['make_id'])])->first();
        if($make){
            $this->make = $make;
        }else{
            $this->make = null;
        }

    }

   

    
      public function setModelId()
    {   

        $this->item['model_id'] = HelperService::modelCleaning($this->item, $this->platformId, $this->prefixes);

<<<<<<< HEAD
    public function varientClean(){
        switch($this->platformId){
           case 1 || 3 || 2 || 17 || 18 || 35 || 15  :
                $value = strtolower($this->item['derivative'] ?? '');
                $value = preg_replace('/\b[0-2]\.\d\b/', '', $value);
                $value = preg_replace('/\b\d+d?r\b/', '', $value);
                $value = preg_replace('/\s+/', ' ', trim($value));
                $value = preg_replace('/\b\d+\s*kw\b/i', '', $value);
                $value = preg_replace('/\b\d+\s*kwh\b/i', '', $value);
                // $value = preg_replace('/\b(auto|manual)\b/i', '', $value);
                // $value = preg_replace('/\b(fwd|rwd|awd|4x4)\b/i', '', $value);
=======
        if($this->make){
>>>>>>> 45798dac67f774b73f48274160dfc1277c60b9f5

            $value  = strtolower($this->item['model_id']);
            $models = VehicleModel::where('make_id',$this->make->id)->get()
                    ->pluck('name')
                    ->map(fn ($name) => strtolower($name))
                    ->toArray();

            if(in_array($value,$models)){
                $this->item['model_id'] = $value;
            }else if($model = HelperService::findWithExplodeFirstWord($value,$models)){
                $this->item['model_id'] = $model;
            // }else if($model = HelperService::findWithExplode($value,$models)){
            //     $this->item['model_id'] = $model;
            }else if($model = HelperService::findInPrefixes($value,$this->prefixes['model'])){
                $this->item['model_id'] = $model;
            }
                                                                                                                                                         
            $this->model = VehicleModel::where('make_id',$this->make->id)->whereRaw('LOWER(name) = ?', [strtolower($this->item['model_id'])])->first();

        }

       

    }


  
    public function setVariantId()
    {       

        $this->item['derivative'] = HelperService::varientCleanByPlatform($this->platformId,$this->item['derivative']);
        $this->item['variant_id'] = $this->item['derivative'];
        $value = strtolower($this->item['variant_id']);

        if(!empty($value) && $this->make && $this->model){
            
            $variants = ModelVariant::where('model_id',$this->model->id)
            ->get()
            ->pluck('name')
            ->map(fn ($name) => strtolower($name))
            ->toArray();  

            if(in_array($value,$variants)){
                $this->item['variant_id'] = $value;
            }else if($previousData = HelperService::findVariableInPreviousData($value, $this->make, $this->model)){
                $this->item['variant_id'] = $previousData;
            }else if($variant = HelperService::matchVariantBySquence($value,$variants)){     
                $this->item['variant_id'] = $variant;
            }else if($variant = HelperService::findWithExplode($value,$variants)){
                $this->item['variant_id'] = $variant;
            }

        }

    }


        public function check()
    {

        $VehicleType = VehicleType::whereRaw('TRIM(vehicle_type.name) = ?',[trim($this->item['vehicle_id'])])->first();
        if(!$VehicleType){
            array_push($this->item['errors'],'VehicleType Not Found');
            return $this->item;
        }

        $BodyType = BodyType::whereRaw('TRIM(name) = ?',[trim($this->item['body_id'])])->first();
        if(!$BodyType){
            array_push($this->item['errors'],'BodyType Not Found');
            return $this->item;
        }

        $AuctionCenter = AuctionCenter::where('name',$this->item['center_id'])->first();
        if(!$AuctionCenter){
            array_push($this->item['errors'],'AuctionCenter Not Found');
            return $this->item;
        }

        
        $Make = Make::whereRaw('TRIM(name) = ?',[trim($this->item['make_id'])])->first();
        if(!$Make){
            array_push($this->item['errors'],'Make Not Found');
            return $this->item;
        }

        $VehicleModel = VehicleModel::whereRaw('TRIM(name) = ?',[trim($this->item['model_id'])])->first();
        if(!$VehicleModel){
            array_push($this->item['errors'],'Model Not Found');
            return $this->item;
        }

        $ModelVariant = ModelVariant::where('name', $this->item['variant_id'])->first();
         if(!$ModelVariant){
            array_push($this->item['errors'],'Variant Not Found');
            return $this->item;
        }

        // $this->item['errors'] = $this->errors;


    }



    

       public function get()
    {
        $this->setBodyId();
        $this->setVehicleId();
        $this->setMakeId();
       
        $this->setModelId();
      
        $this->setVariantId();
        return $this->item;
    }

   

}
