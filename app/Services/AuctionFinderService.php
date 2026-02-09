<?php

namespace App\Services;

use App\Models\Auctions;
use App\Models\Interest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuctionFinderService 
{

    protected $request;
    protected $id;
    public $response;

    public function __construct($request,$id) {
        $this->request = $request;
        $this->id = $id;

        if (method_exists(self::class, $id)) {
            $this->response = call_user_func([self::class, $id]);
        }else{
             $this->response = $this->general();
        }

       

    }


     public function general()
    {

        $label = 'vehicles.'.$this->id.' as label';
        $query = Vehicle::query()
            ->whereNotNull('vehicles.'.$this->id)
            ->where('vehicles.'.$this->id, '!=', '')
            ->select([
                $label, 
                DB::raw('COUNT(vehicles.id) as count')
            ])
            ->groupBy('vehicles.'.$this->id)
            ->orderByDesc('count')
            ->get()
            ->map(function($item){
                return [
                    'id' => $item->label,
                    'label' => $item->label,
                    'count' => $item->count
                ];
            });

        return  [
            'message' => 'Get Record '.$this->id,
            'data' => $query,
        ];
    
    }


   


}
