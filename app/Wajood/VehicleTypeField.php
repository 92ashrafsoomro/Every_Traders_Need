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


    class VehicleTypeField 
{

    public $row;
    public $value;
    public $data = [];

    function __construct(VehicleRow $row){

        $this->row = $row;
        $this->value = $this->row->item['body_id'];

        $this->data = BodyType::pluck('name')->map(fn ($name) => strtolower($name))->toArray();

    }




    public function default()
    {

         $value = strtolower($this->value);

        // Direct Check
        if(in_array($value,$this->data)){
            return $this->value;
        }

        // Check in Prefix
        $bodyPrefix = $this->row->main->bodyPrefix($value); 
        if($bodyPrefix && in_array($bodyPrefix,$this->data)){
            return $bodyPrefix;
        }

        return $this->value;

    }



    public function handle(){

    
        // if(in_array($$this->row->main->auction->platform_id,[15])){
        //     return $this->showrem();
        // }

        return $this->default();
    }


      public function get()
    {
        $value = $this->handle();
        return $value;
    }



}
