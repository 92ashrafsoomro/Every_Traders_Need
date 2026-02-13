<?php

namespace App\Wajood;

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
use App\Wajood\VehicleRow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

    

    class VehicleHelper 
{

    protected $prefixes;


    public function modelPrefix($value){
        $prefixes = $this->prefixes['model'];
        return isset($prefixes[$value]) ? $prefixes[$value] : null;
    }

    public function makePrefix($value){
        $prefixes = $this->prefixes['make'];
        return isset($prefixes[$value]) ? $prefixes[$value] : null;
    }

    public function bodyPrefix($value){
        $prefixes = $this->prefixes['bodyType'];
        return isset($prefixes[$value]) ? $prefixes[$value] : null;
    }
    public function vehicleTypePrefix($value){
        $prefixes = $this->prefixes['vehicleType'];
        return isset($prefixes[$value]) ? $prefixes[$value] : null;
    }


        public  function findWithExplode($value,$data)
    {

            $words = explode(" ",$value);
            foreach ($words as $word){
                if(in_array($word,$data)){
                    return  $word;
                }
            }

            return false;
    
    }


        public function matchVariantBySquence($value,$variants)
    {

            $words = explode(" ",$value); 
            if(isset($words[2])){

                if(in_array($words[0].' '.$words[1].' '.$words[2],$variants)){
                return $words[0].' '.$words[1].' '.$words[2];
                }else if(in_array($words[0].' '.$words[1],$variants)){
                    return $words[0].' '.$words[1];
                }else if(in_array($words[0],$variants)){
                    return $words[0];
                }

            }else if(isset($words[1])){
                
                if(in_array($words[0].' '.$words[1],$variants)){ 
                    return $words[0].' '.$words[1];
                }else if(in_array($words[0],$variants)){ 
                    return $words[0];
                }

            }else if(isset($words[0])){
                if(in_array($words[0],$variants)){ 
                    return $words[0];
                }
            }

            return null;
    
    }


    
        public function findVariantByOldDerivative($derivative, Make $make,VehicleModel $model)
    {
        $v = Vehicle::where('make_id',$make->id)
                    ->where('model_id',$model->id)
                    ->whereRaw('LOWER(derivative) = ?', [strtolower($derivative)])
                    ->first();
        if($v){
            return $v->variant->name;
        }else{
            return null;
        }

    }
    


  


    
   

}

