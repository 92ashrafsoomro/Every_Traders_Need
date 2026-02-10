<?php

namespace App\Services;

use App\Models\Auctions;
use App\Models\Interest;
use App\Models\Make;
use App\Models\ModelVariant;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleModel;
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



    public function make()
    {

        $query = Make::join('vehicles', 'vehicles.make_id', '=', 'make.id')
            ->join('auctions', 'auctions.id', '=', 'vehicles.auction_id');
       
         $data  =  $query->select([
                            'make.id',
                            'make.name as label',
                            DB::raw('COUNT(vehicles.id) as count'),
                        ])
                        ->groupBy('make.id', 'make.name')
                        ->orderByDesc('count')
                        ->get();


        return [
            'total' => count($data),
            'data' => $data,
        ];

    }


    public function model()
    {

        $query = VehicleModel::join('make', 'make.id', '=', 'model.make_id')
            ->join('vehicles', 'vehicles.model_id', '=', 'model.id')
            ->whereIn('model.make_id',$this->request->makes ?? []);

        
            $data   = $query->select([
                                'model.id',
                                'model.name as label',
                                'make.name as make',
                                DB::raw('COUNT(model.id) as count')
                            ])
                            ->groupBy('model.id')
                            ->orderBy('count', 'desc')
                            ->get();

            return [
                "total" => count($data),
                'data' => $data,
            ];

    }




    public function variant()
    {
      

        $query = ModelVariant::join('model', 'model.id', '=', 'model_variant.model_id')
                ->leftJoin('vehicles', 'vehicles.variant_id', '=', 'model_variant.id')
                ->whereIn('model_variant.model_id',$this->request->models ?? []);

        // if ($this->request->filled('model')) {
        //     if (is_array($this->request->model_id)) {
        //         $query->whereIn('model_variant.model_id', $this->request->model);
        //     } else {
        //         $query->where('model_variant.model_id', $this->request->model);
        //     }
        // }

        $data = $query->select([
                    'model_variant.id',
                    'model_variant.name as label',
                    'model.name as model',
                    DB::raw('COUNT(vehicles.id) as count')
                ])
                ->groupBy('model.id')
                ->orderBy('count', 'desc')
                ->get();

        return [
            "total" => count($data),
            "data" => $data
        ];
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
