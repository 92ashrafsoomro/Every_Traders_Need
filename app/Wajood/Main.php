<?php

namespace App\Wajood;

use App\Models\AuctionCenter;
use App\Models\AuctionPlatform;
use App\Models\Auctions;
use App\Models\Interest;
use App\Models\Make;
use App\Models\ModelVariant;
use App\Models\Prefix;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class Main 
{

    public $response;
    public $auctionId;
    public $auction;
    public $prefixes = [];

    public function __construct($request){

        $this->response = $request;
        $this->auctionId = $request->route('id');

        $this->loadAuction();
        $this->loadPrefixes();
        
    }


    public function loadAuction(){
        
        $this->auction = Auctions::where('id',$this->auctionId)->first();
        if(!$this->auction){
          throw new Exception("Auction Not Found", 1);
        }

    }


    
    public function loadPrefixes(){

        $prefixes = [];
        $prefix = Prefix::orderBy('prefix_key')->get();
        foreach ($prefix as $key => $value) {
            $prefixes[$value->name][strtolower($value->prefix_key)] = $value->prefix_value;
        }
        $this->prefixes =  $prefixes;

    }



    public function get(){

        // return $this->response;

        return  [
                        'message' => 'Record Updated Successfully',
                        'auction' =>  $this->auction,
                        'data' =>  [],
                ];


    }

 
    
}
