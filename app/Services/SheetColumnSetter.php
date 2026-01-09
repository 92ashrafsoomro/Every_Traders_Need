<?php

namespace App\Services;

use App\Models\Auctions;
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


        // dd($this->item);



    
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
            $orginal = $this->item['variant_id'];
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

                            $words = explode(" ",$value);
                            if(isset($words[0]) && !is_numeric($words[0])){
                                 if(in_array($words[0],$variants)){
                                    $this->item['variant_id'] = $words[0] .'-- '.$orginal;
                                 }   
                            

                            }else if(isset($words[1]) && !is_numeric($words[1])){
                                if(in_array($words[1],$variants)){
                                    $this->item['variant_id'] = $words[1] .'-- '.$orginal;
                                } 
                            

                            } else if(isset($words[2]) && !is_numeric($words[2])){
                                if(in_array($words[2],$variants)){ 
                                    $this->item['variant_id'] = $words[2] .'-- '.$orginal;
                                }

                            }

                        }
                     
                        
                        
                        
                }

            }
       

           

            
            
            // $prefixes = $this->prefixes['variant'];
            // $value = strtolower($this->item['variant_id']);
        
            // $value = isset($prefixes[$value]) ? $prefixes[$value] : $value;
        
            // $this->item['variant_id'] = $value;

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
