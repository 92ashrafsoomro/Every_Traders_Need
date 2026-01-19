<?php

namespace App\Services;

use App\Models\AuctionCenter;
use App\Models\Auctions;
use App\Models\BodyType;
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

    function __construct($item) {
        $this->item = $item;
        $this->item['errors'] = [];
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
    }

        public function setModelId()
    {
        $prefixes = $this->prefixes['model'];
        $value = strtolower($this->item['model_id']);
        $value = isset($prefixes[$value]) ? $prefixes[$value] : $value;
        $this->item['model_id'] = $value;

    }

    
        public function setVariantId()
    {       

            $this->item['variant_id'] = $this->item['derivative'];

            $value = strtolower($this->item['variant_id']);

            $make = Make::where('name', $this->item['make_id'])->first();
            if($make){
                $model = VehicleModel::where('name', $this->item['model_id'])->where('make_id',$make->id)->first();
                if($model){

                        $variants = ModelVariant::where('model_id',$model->id)
                                    ->get()
                                    ->pluck('name')
                                    ->map(fn ($name) => strtolower($name))
                                    ->toArray();  
                      
                        if(!empty($value)){

                            // $v = Vehicle::where('make_id',$make->id)
                            // ->where('model_id',$model->id)
                            // ->whereRaw('LOWER(derivative) = ?', [strtolower($this->item['derivative'])])
                            // ->first();
                            // if($v){
                             
                            //      $this->item['variant_id'] = $v->variant->name;
                            // }else{

                                $words = explode(" ",$value);

                                if(isset($words[2])){
                                    
                                    if(in_array($words[0].' '.$words[1].' '.$words[2],$variants)){ 
                                        $this->item['variant_id'] = $words[0].' '.$words[1].' '.$words[2];
                                    }else if(in_array($words[0].' '.$words[1],$variants)){ 
                                        $this->item['variant_id'] = $words[0].' '.$words[1];
                                    }else if(in_array($words[0],$variants)){ 
                                        $this->item['variant_id'] = $words[0];
                                    }

                                }else if(isset($words[1])){
                                    
                                    if(in_array($words[0].' '.$words[1],$variants)){ 
                                        $this->item['variant_id'] = $words[0].' '.$words[1];
                                    }else if(in_array($words[0],$variants)){ 
                                        $this->item['variant_id'] = $words[0];
                                    }

                                }else{
                                    if(in_array($words[0],$variants)){ 
                                        $this->item['variant_id'] = $words[0];
                                    }
                                }

                            // }

                        }

                }

            }

            // $prefixes = $this->prefixes['variant'];
            // $value = strtolower($this->item['variant_id']);
            // $value = isset($prefixes[$value]) ? $prefixes[$value] : $value;
            // $this->item['variant_id'] = $value;
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
