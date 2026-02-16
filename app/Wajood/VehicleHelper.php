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
        return isset($prefixes[$value]) ? strtolower($prefixes[$value]) : null;
    }

    public function makePrefix($value){
        $prefixes = $this->prefixes['make'];
        return isset($prefixes[$value]) ? strtolower($prefixes[$value]) : null;
    }

    public function bodyPrefix($value){
        $prefixes = $this->prefixes['bodyType'];
        return isset($prefixes[$value]) ? strtolower($prefixes[$value]) : null;
    }
    public function centerPrefix($value){
        $prefixes = $this->prefixes['center'];
        return isset($prefixes[$value]) ? strtolower($prefixes[$value]) : null;
    }
    public function fuelTypePrefix($value){
        $prefixes = $this->prefixes['fuelType'];
        return isset($prefixes[$value]) ? strtolower($prefixes[$value]) : null;
    }
    public function transmissionTypePrefix($value){
        $prefixes = $this->prefixes['transmission'];
        return isset($prefixes[$value]) ? strtolower($prefixes[$value]) : null;
    }
    public function vehicleTypePrefix($value){
        $prefixes = $this->prefixes['vehicleType'];
        return isset($prefixes[$value]) ? strtolower($prefixes[$value]) : null;
    }


        public  function findWithExplode($value,$data)
    {

            $words = explode(" ",$value);
            foreach ($words as $word){
                if(in_array($word,$data)){
                    return  strtolower($word);
                }
            }

            return false;
    
    }


        public function matchVariantBySquence($value,$variants)
    {

            $words = explode(" ",$value); 
            if(isset($words[2])){

                if(in_array($words[0].' '.$words[1].' '.$words[2],$variants)){
                return strtolower($words[0].' '.$words[1].' '.$words[2]);

                }else if(in_array($words[0].' '.$words[1],$variants)){
                    return strtolower($words[0].' '.$words[1]);
                }else if(in_array($words[0],$variants)){
                    return strtolower($words[0]);
                }

            }else if(isset($words[1])){
                
                if(in_array($words[0].' '.$words[1],$variants)){ 
                    return strtolower($words[0].' '.$words[1]);
                }else if(in_array($words[0],$variants)){ 
                    return strtolower($words[0]);
                }

            }else if(isset($words[0])){
                if(in_array($words[0],$variants)){ 
                    return strtolower($words[0]);
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
                return strtolower($v->variant->name);
            }else{
                return null;
            }

    }


        public function removeBodyInModel($value)
    {
            $value = strtolower($value);

            $bodyMap = $this->prefixes['bodyType'];
            $fuelMap = $this->prefixes['fuelType'];
            $manualFuel = ['diesel', 'petrol'];
                
            $words = preg_split('/\s+/', trim($value));

            for ($i = count($words) - 1; $i >= 0; $i--) {

                $word = trim(strtolower($words[$i]));
                $remove = false;

                if (in_array($word, $manualFuel)) {
                    $remove = true;
                }

                if (!$remove) {
                    foreach ($bodyMap as $key => $mappedValue) {
                        if (stripos($word, strtolower($key)) !== false) {
                            $remove = true;
                            break;
                        }
                    }
                }

                if (!$remove) {
                    foreach ($fuelMap as  $key => $mappedValue) {
                        if (stripos($word, strtolower($key)) !== false) {
                            $remove = true;
                            break;
                        }
                    }
                }

                if ($remove) {
                    array_splice($words, $i, 1);
                }
            }

            $value = implode(' ', $words);

            return strtolower($value);
    }
    


  


    
   

}

