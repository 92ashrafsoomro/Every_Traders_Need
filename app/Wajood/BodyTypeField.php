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


    class BodyTypeField 
{

    public $row;
    public $value;
  


    function __construct(VehicleRow $row) {

        $this->row = $row;
        $this->value = $this->row->item['body_id'];

    }



    public function platform(){


        $value = strtolower($this->value);

        // Direct Check
        if(in_array($value,$this->row->models)){
            return $this->value;
        }

        // Check in Prefix
        $value = $this->row->main->bodyPrefix($value) ?? $value; 
        if(in_array($value,$this->row->models)){
            return $value;
        }

        return $this->value;

    }



    public function handleByPlatform(){

        $platform = $this->row->main->auction->platform_id;

        if(in_array($platform,[])){
            return $this->platform();
        }else{
            return $this->platform();
        }

    }


      public function get()
    {
        $value = $this->handleByPlatform();
        return $value;
    }



}
