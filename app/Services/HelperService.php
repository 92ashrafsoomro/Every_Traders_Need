<?php

namespace App\Services;

use App\Models\Make;
use App\Models\Membership;
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

class HelperService 
{


        public static function findVariableInPreviousData($derivative, Make $make,VehicleModel $model)
    {
        $v = Vehicle::where('make_id',$make->id)
                    ->where('model_id',$model->id)
                    ->whereRaw('LOWER(derivative) = ?', [strtolower($derivative)])
                    ->first();
        if($v){
            return $v->variant->name;
        }else{
            return false;
        }

    }


        public static function matchVariantBySquence($value,$variants)
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

            return false;
    
    }


        public static function findWithExplode($value,$data)
    {

            $words = explode(" ",$value);
            foreach ($words as $word){
                if(in_array($word,$data)){
                    return  $word;
                }
            }

            return false;
    
    }


    public static function varientCleanByPlatform($platformId,$derivative){
        
        switch($platformId){
           case 1 || 2 || 17 || 18 || 35 || 15  :
                $value = strtolower($derivative ?? '');
                $value = preg_replace('/\b[0-2]\.\d\b/', '', $value);
                $value = preg_replace('/\b\d+d?r\b/', '', $value);
                $value = preg_replace('/\s+/', ' ', trim($value));
                $value = preg_replace('/\b\d+\s*kw\b/i', '', $value);
                // $value = preg_replace('/\b(auto|manual)\b/i', '', $value);
                // $value = preg_replace('/\b(fwd|rwd|awd|4x4)\b/i', '', $value);

                return $value;
        }

    }


        public static function findInPrefixes($value,$prefixes)
    {

            if(isset($prefixes[$value])){
                return $prefixes[$value];
            }

            return false;
    
    }



    public static function modelCleaning($value,$platformId,$prefixes){


        switch($platformId){
           case 2:

                $value = strtolower($value);
                $words = preg_split('/\s+/', trim($value));

                $bodyMap = $prefixes['bodyType']; 
                $fuelMap = $prefixes['fuelType']; 
                $manualFuel = ['diesel', 'petrol'];

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

                return implode(' ', $words);

            //Returning The Default Value
            default:
            return $value;
         
        }



    }







}