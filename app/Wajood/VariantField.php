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


    class VariantField 
{

    public $row;
    public $value;
    public $data = [];

    function __construct(VehicleRow $row) {

        $this->row = $row;
        $this->value = $this->row->item['derivative'];
        if($this->row->model){
            $this->data = ModelVariant::where('model_id',$this->row->model->id)
                          ->pluck('name')
                          ->map(fn ($name) => strtolower($name))
                          ->toArray();
        }

    }


    public function platforms(){


            // Case 3 findVariantByOldDerivative
            if($this->row->make && $this->row->model){
                $findVariantByOldDerivative = $this->row->main->findVariantByOldDerivative($this->row->item['derivative'],$this->row->make,$this->row->model);
                if($findVariantByOldDerivative && in_array($findVariantByOldDerivative,$this->data)){
                return $findVariantByOldDerivative;
                }
            }


            $value = strtolower($this->value);
            $value = strtolower($this->item['derivative'] ?? '');
            $value = preg_replace('/\b[0-2]\.\d\b/', '', $value);
            $value = preg_replace('/\b\d+d?r\b/', '', $value);
            $value = preg_replace('/\s+/', ' ', trim($value));
            $value = preg_replace('/\b\d+\s*kw\b/i', '', $value);
            $value = preg_replace('/\b\d+\s*kwh\b/i', '', $value);


            // Case 1 Direct Check
            if(in_array($value,$this->data)){
                return $value;
            }

            // Case 2 Check in Prefix
            $prefixValue = $this->row->main->modelPrefix($value); 
            if($prefixValue && in_array($prefixValue,$this->data)){
                return $prefixValue;
            }


            // matchVariantBySquence
            $matchVariantBySquence = $this->row->main->matchVariantBySquence($value,$this->data);
            if($matchVariantBySquence && in_array($matchVariantBySquence,$this->data)){
            return $matchVariantBySquence;
            }

            // Exploded Value
            $findWithExplode = $this->row->main->findWithExplode($value,$this->data); 
            if($findWithExplode && in_array($findWithExplode,$this->data)){
                return $findWithExplode;
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

        // Case 3 findVariantByOldDerivative
        if($this->row->make && $this->row->model){
            $findVariantByOldDerivative = $this->row->main->findVariantByOldDerivative($this->row->item['derivative'],$this->row->make,$this->row->model);
            if($findVariantByOldDerivative && in_array($findVariantByOldDerivative,$this->data)){
            return $findVariantByOldDerivative;
            }
        }
        
        // matchVariantBySquence
        $matchVariantBySquence = $this->row->main->matchVariantBySquence($value,$this->data);
        if($matchVariantBySquence && in_array($matchVariantBySquence,$this->data)){
           return $matchVariantBySquence;
        }

        // Exploded Value
        $findWithExplode = $this->row->main->findWithExplode($value,$this->data); 
        if($findWithExplode && in_array($findWithExplode,$this->data)){
            return $findWithExplode;
        }

        return $this->value;

    }



        public function handle()
    {

        if(in_array($this->row->main->auction->platform_id,[1,3,2,17,18,35,15])){
            return $this->platforms();
        }

        return $this->default();

    }


      public function get()
    {
        $value = $this->handle();
        $this->row->model = ModelVariant::whereRaw('LOWER(name) = ?', [strtolower($value)])->first();
        return $value;
    }



}