<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\AuctionCenter;
use App\Models\AuctionStatus;
use App\Models\AuctionType;
use App\Models\Color;
use App\Models\Make;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Services\AuctionService;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;


class AuctionStatusController extends Controller
{

      public function index(Request $request)
    {

        $length = $request->input('length', 50);
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $length;

        //Query
        $query = AuctionStatus::query();

        //Filter
        if($request->has('id') && $request->id != '') {
            $query->where('id',$request->id);
        }

        $count = (clone $query)->count();
        $data = $query->skip($offset)
                ->take($length)
                ->orderByDesc('id')
                ->get()
                ->map(function($item){
                     $item->date = Carbon::parse($item->created_at)->format('Y-m-d');
                    return $item;
                });
            

        return response()->json([
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'page' => $page,
            'offset' => $offset,
            'last_page' => ceil($count / $length),
            'data' => $data,
        ]);

    }


 

}
