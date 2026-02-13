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


    class MakeField 
{
    
    public $row;
    public $value;
    public $data = [];


    function __construct(VehicleRow $row){

        $this->row   = $row;
        $this->value = $this->row->item['make_id'];
        $this->data  = Make::pluck('name')->map(fn ($name) => strtolower($name))->toArray();

    }

    

    public function default(){

        $value = strtolower($this->value);

        // Case Direct Check
        if(in_array($value,$this->data)){
            return $value;
        }

        // Case Check in Prefix
        $makePrefix = $this->row->main->makePrefix($value); 
        if($makePrefix){
            if(in_array($makePrefix,$this->data)){
             return $makePrefix;
            }
        }
        
        // Return Default
        return $this->value;

    }



    public function handle(){
        
        // Default
        return $this->default();
    }



        public function get()
    {

        $value = $this->handle();
        $make = Make::whereRaw('LOWER(name) = ?', [$value])->first();

        $this->row->make = $make ? $make : null;

        return $value;

    }

   
}
