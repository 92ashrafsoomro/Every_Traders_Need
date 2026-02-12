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

    function __construct(VehicleRow $row) {

        $this->row = $row;

    }


      public function get()
    {

            $prefixes = $this->row->main->prefixes['make'];
            $value = strtolower($this->row->item['make_id']);

            $value = isset($prefixes[$value]) ? $prefixes[$value] : $value;
            $this->row->item['make_id'] = $value;

            $make = Make::whereRaw('LOWER(name) = ?', [strtolower($this->row->item['make_id'])])->first();
            if($make){

                $this->row->make   = $make;
                $this->row->models = VehicleModel::where('make_id',$make->id)->get()
                                        ->pluck('name')
                                        ->map(fn ($name) => strtolower($name))
                                        ->toArray();
            }else{
                $this->row->make = null;
                $this->row->models = [];
            }


            return $this->row->item['make_id'];

    }

   


    
   

}
