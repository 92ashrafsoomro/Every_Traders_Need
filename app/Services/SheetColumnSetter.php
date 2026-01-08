<?php

namespace App\Services;

use App\Models\Auctions;
use App\Models\Interest;
use App\Models\Membership;
use App\Models\MembershipPayment;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
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
        
        $value = $this->item['body_id'];
        $this->item['vehicle_id'] = $value;

    }
    
        public function get()
    {
        $this->setBodyId();
        $this->setVehicleId();
        return $this->item;

    }

   

}
