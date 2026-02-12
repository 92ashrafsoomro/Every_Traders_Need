<?php

namespace App\Wajood;

use App\Models\AuctionCenter;
use App\Models\AuctionPlatform;
use App\Models\Auctions;
use App\Models\Interest;
use App\Models\Prefix;
use App\Models\ScrapedVehicle;
use Illuminate\Http\Request;
use App\Wajood\VehicleRow;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class VehicleMain extends VehicleHelper

{

    protected $request;
    protected $auctionId;
    public $auction;
    public $prefixes = [];
    protected $items;


    public function __construct($request){

        $this->request  = $request;
        $this->auctionId = $request->route('id');
        $this->loadAuction();
        $this->loadPrefixes();
        $this->loadScraper();
        $this->startFilteration();


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


    public function loadScraper(){
        
        $scrap = ScrapedVehicle::select('payload')->where('auction_id',$this->auction->id)->pluck('payload')->first();
        $this->items = json_decode($scrap,true);

    }


    public function startFilteration(){
        

        $this->items = array_map(function($item){

            $VehicleRow = new VehicleRow($this,$item);
            return $VehicleRow->get();

        }, $this->items);

    }


    public function get(){
        
        return  [
                    'message' => 'Record Updated Successfully',
                    'auction' =>  $this->auction,
                    'data' =>  $this->items,
                ];

    }

 

    
}
