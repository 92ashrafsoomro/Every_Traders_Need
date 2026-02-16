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


    class ModelField 
{

    public $row;
    public $value;
    public $data = [];

    function __construct(VehicleRow $row) {

        $this->row = $row;
        $this->value = $this->row->item['model_id'];
        if($this->row->make){
            $this->data = VehicleModel::where('make_id',$this->row->make->id)
                          ->pluck('name')
                          ->map(fn ($name) => strtolower($name))
                          ->toArray();
        }

    }


    public function astonBarlayClean(){

            $value = strtolower($this->value);
            $bodyMap = $this->row->main->prefixes['bodyType'];
            $fuelMap = $this->row->main->prefixes['fuelType'];
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


            // Case 1 Direct Check
            if(in_array($value,$this->data)){
                return $this->value;
            }

            // Case 2 Check in Prefix
            $prefixValue = $this->row->main->modelPrefix($value); 
            if($prefixValue && in_array($prefixValue,$this->data)){
                return $prefixValue;
            }

            return $this->value;

    }



    public function wilianmSon()
    {

        $title  = strtolower($this->row->item['title']);
        $titles =  explode(' ',$title);
        $model1 = isset($titles[1]) ? $titles[1].' ' : '';
        $model2 = isset($titles[2]) ? $titles[2] : '';
        $value = $model1.$model2;


        // Case 1 Direct Check
        if(in_array($value,$this->data)){
            return $this->value;
        }

        // Case 2 Check in Prefix
        $prefixValue = $this->row->main->modelPrefix($value); 
        if($prefixValue && in_array($prefixValue,$this->data)){
            return $prefixValue;
        }
 
        return $this->value;

    }




    public function default()
    {

        $value = strtolower($this->value);

        // Case 1 Direct Check
        if(in_array($value,$this->data)){
            return $this->value;
        }

        // Case 2 Check in Prefix
        $prefixValue = $this->row->main->modelPrefix($value); 
        if($prefixValue && in_array($prefixValue,$this->data)){
            return $prefixValue;
        }

        return $this->value;

    }



    public function handle(){

        if(in_array($this->row->main->auction->platform_id,[2])){
            return $this->astonBarlayClean();
        }

        if(in_array($this->row->main->auction->platform_id,[9])){
            return $this->wilianmSon();
        }

        return $this->default();

    }



      public function get()
    {
        $value = $this->handle();
        if($this->row->make){
            $this->row->model = VehicleModel::where('make_id',$this->row->make->id)->whereRaw('LOWER(name) = ?', [strtolower($value)])->first();
        }
        return $value;
        
    }



}
