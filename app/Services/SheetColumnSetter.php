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

            $make = Make::where('name', $this->item['make_id'])->first();
            if($make){
                $model = VehicleModel::where('name', $this->item['model_id'])->where('make_id',$make->id)->first();
                if($model){

                   

                        $variant = ModelVariant::where('model_id',$model->id)->get();
                        //  dd($this->item);
                        //  dd($variant->toArray());
                        // dd($this->item['variant_id']);
                        

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
