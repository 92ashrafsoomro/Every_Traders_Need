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
    


  


    
   

}

