<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\AuctionCenter;
use App\Models\Color;
use App\Models\Make;
use App\Models\News;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Services\AuctionService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;


class NewsController extends Controller
{

      public function index(Request $request)
    {

        $length = $request->input('length', 50);
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $length;

        //Query
        $query = News::query();

        //Filter
        if($request->has('id') && $request->id != '') {
            $query->where('id',$request->id);
        }

        $count = (clone $query)->count();
        $data = $query->select([
                    '*'
                ])
                ->skip($offset)
                ->take($length)
                ->orderByDesc('id')
                ->get()
                ->map(function($item){
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


      public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'image' => 'nullable|image',
            'description' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'category_id' => 'nullable|exists:news_categories,id',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $model = News::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => Carbon::parse($request->date),
            'created_at' => Carbon::now(),
            'updated_at' => NULL,
            'created_by' => Auth::user()->id,
        ]);

        
        if ($request->file('image')) {
            $fileName = time() . '__ff__' . $request->file('image')->getClientOriginalName();
            $filePath = public_path('uploads/');
            $request->file('image')->move($filePath, $fileName);
            $model->image = $fileName;
            $model->save();
        }

        return response()->json([
            'message' => 'Record Created Successfully',
            'data' => $model
        ],200);

        
    }


       public function update(Request $request,$id)
    {

        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'description' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'category_id' => 'nullable|exists:news_categories,id',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }


        $model = News::find($id);
        if(!$model){
            return response()->json([
                'message' => 'Record Not Found',
            ], 422);
        }

        $model->where('id',$id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => Carbon::parse($request->date),
            'created_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        if ($request->file('image')) {
            // Remove existing thumbnail if it exists
            if ($model->image && file_exists(public_path('uploads/' . $model->image))) {
                unlink(public_path('uploads/' . $model->image));
            }
            $fileName = time() . '__ff__' . $request->file('image')->getClientOriginalName();
            $filePath = public_path('uploads/');
            $request->file('image')->move($filePath, $fileName);
            $model->image = $fileName;
            $model->save();
        }

        
        return response()->json([
            'message' => 'Record Updated Successfully',
            'data' => $model
        ],200);
        
    }


    public function destroy($id)
    {

        $model = News::find($id);
        if(!$model){
            return response()->json(['message' => 'Record Not Found.'], 422);
        }

        $model->delete();
        return response()->json(['message' =>'Record deleted successfully.'], 200);

    }


}
