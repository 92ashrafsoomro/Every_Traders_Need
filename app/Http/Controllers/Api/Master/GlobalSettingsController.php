<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;

use App\Models\Make;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class GlobalSettingsController extends Controller
{


      public function index(Request $request)
    {

        $length = $request->input('length', 50);
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $length;

        //Query
        $query = Make::query();

        //Filter
        if($request->has('id') && $request->id != '') {
            $query->where('id',$request->id);
        }

        if($request->filled('name')){
            $query->whereRaw('LOWER(name) = ?',[strtolower($request->name)]);
        }
        
        if($request->filled('search')) {
            $query->where('make.name', 'like', '%'.$request->search.'%');
            $query->orWhere('make.id', 'like', '%'.$request->search.'%');
        }

        $count = (clone $query)->count();
        $data  = $query->select([
                    '*'
                ])
                ->skip($offset)
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
