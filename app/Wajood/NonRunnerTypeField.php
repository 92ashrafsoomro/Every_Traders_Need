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


    class NonRunnerTypeField 
{

    public $row;
    public $value;
    public $data = [];

    function __construct(VehicleRow $row){

        $this->row = $row;
        $this->value = $this->row->item['engine_runs'];

    }




    public function default()
    {

        $value = strtolower($this->value);
        if(in_array($value,['Non','non','False','false','0',0])){
            return 'No';
        }else if(in_array($value,['True','true','ok','1',1])){
            return 'Yes';
        }
        return $this->value;

    }



    public function handle(){

        return $this->default();
    }


      public function get()
    {
        $value = $this->handle();
        return $value;
    }



}
