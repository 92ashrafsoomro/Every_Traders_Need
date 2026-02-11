<?php

namespace App\Wajood;

use App\Models\AuctionCenter;
use App\Models\AuctionPlatform;
use App\Models\Auctions;
use App\Models\Interest;
use App\Models\Make;
use App\Models\ModelVariant;
use App\Models\Prefix;
use App\Models\ScrapedVehicle;
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


abstract class Row 
{

   
    protected $auctionId;
    protected $auction;
    protected $prefixes = [];
    protected $items = [];


    public function __construct() {

        $this->handle();

    } 


    public function handle(){

        $this->items = array_map(function($item) {
            
            return $item;

        }, $this->items);
        
    }




   

 

    
}
