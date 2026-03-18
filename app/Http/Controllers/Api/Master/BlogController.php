<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\AuctionCenter;
use App\Models\Blog;
use App\Models\Color;
use App\Models\Make;
use App\Models\News;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\BlogDetail;
use App\Models\Setting;
use App\Models\UserNotificationSetting;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Services\AuctionService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Services\NewsAndBlogService;


class BlogController extends Controller
{

      public function index(Request $request)
    {

        $length = $request->input('length', 50);
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $length;

        //Query
        $query = Blog::query()->with('category', 'author');

        //Filter
        if($request->filled('search')) {
                $query->where('title', 'like', '%'.$request->search.'%');
        }
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

    public function store(Request $request ,NewsAndBlogService $newsService)
    {

        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'image' => 'nullable|image',
            'description' => 'required|string|max:10000',
            'date' => 'required|string|max:255',
            'category_id' => 'required|exists:blog_categories,id',

            'sections' => 'nullable|array',
            'sections.*.distitle' => 'nullable|string|max:255',
            'sections.*.disdescription' => 'nullable|string',
            // 'sections.*.alignment' => 'nullable|string|in:left,center,right',
            // 'sections.*.disimage' => 'nullable|image|max:2048',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $slug = Str::slug($request->title);

        $count = Blog::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count) {
            $slug = $slug . '-' . ($count + 1);
        }

        $model = Blog::create([
            'title' => $request->title,
            'slug'  => $slug,
            'description' => $request->description,
            'date' => Carbon::parse($request->date),
            'category_id' => $request->category_id,
            'author_id' => Auth::user()->id,
        ]);

        if ($request->file('image')) {
            $model->updateImage($request->file('image'));
        }

        if ($request->has('sections')) {
            foreach ($request->sections as $index => $sectionData) {
                $section = $model->details()->create([
                    'title' => $sectionData['distitle'] ?? null,
                    'description' => $sectionData['disdescription'] ?? null,
                    'alignment' => $sectionData['alignment'] ?? 'left',
                ]);
                if ($request->hasFile("sections.$index.disimage")) {
                        $file = $request->file("sections.$index.disimage");
                        $section->uploadSectionImage($file);
                }
            }
        }


        $newsService->sendNotification($model->title, $model->description);


        return response()->json([
            'message' => 'Record Created Successfully',
            'data' => $model
        ],200);
    }


    public function show(Request $request,$id)
    {

            $model = Blog::with('details')->find($id);
            if(!$model){
                return response()->json([
                    'message' => 'Record Not Found',
                ], 422);
            }

        

            return response()->json([
                'message' => 'Record Updated Successfully',
                'data' => $model
            ],200);

        
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image',
            'description' => 'required|string|max:10000',
            'date' => 'required|string|max:255',
            'category_id' => 'nullable|exists:blog_categories,id',
            // 'sections' => 'nullable|array',
            // 'sections.*.distitle' => 'nullable|string|max:255',
            // 'sections.*.disdescription' => 'nullable|string',
            // 'sections.*.alignment' => 'nullable|string|in:left,center,right',
            // 'sections.*.disimage' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $model = Blog::find($id);
        if (!$model) {
            return response()->json(['message' => 'Record Not Found'], 404);
        }


        if ($model->title !== $request->title) {
            $slug = Str::slug($request->title);
            $count = Blog::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $id)->count();
            if ($count) {
                $slug = $slug . '-' . ($count + 1);
            }
            $model->slug = $slug;
        }


        $model->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => Carbon::parse($request->date),
            'category_id' => $request->category_id,
        ]);


        if ($request->hasFile('image')) {
            $model->updateImage($request->file('image'));
        }


        foreach ($model->details as $oldSection) {
            if ($oldSection->image) {
                $oldFilePath = public_path('uploads/sections/' . $oldSection->image);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }
        }
        $model->details()->delete();

        if ($request->has('sections')) {
            $existingIds = [];

            foreach ($request->sections as $index => $sectionData) {

                if (isset($sectionData['id']) && !empty($sectionData['id'])) {
                    $section = BlogDetail::find($sectionData['id']);
                    if ($section) {
                        $section->update([
                            'title' => $sectionData['distitle'] ?? null,
                            'description' => $sectionData['disdescription'] ?? null,
                            'alignment' => $sectionData['alignment'] ?? 'left',
                        ]);
                        $existingIds[] = $section->id;
                    }
                } else {
                    $section = $model->details()->create([
                        'title' => $sectionData['distitle'] ?? null,
                        'description' => $sectionData['disdescription'] ?? null,
                        'alignment' => $sectionData['alignment'] ?? 'left',
                    ]);
                    $existingIds[] = $section->id;
                }


                if ($request->hasFile("sections.$index.disimage")) {
                    $file = $request->file("sections.$index.disimage");
                    $section->uploadSectionImage($file); 
                }
            
            }


            $model->details()->whereNotIn('id', $existingIds)->get()->each(function($oldSection) {
                if ($oldSection->image) {
                    $path = public_path('uploads/sections/' . $oldSection->image);
                    if (File::exists($path)) { File::delete($path); }
                }
                $oldSection->delete();
            });
        } else {
            $model->details()->get()->each(function($oldSection) {
                if ($oldSection->image) {
                    $path = public_path('uploads/sections/' . $oldSection->image);
                    if (File::exists($path)) { File::delete($path); }
                }
                $oldSection->delete();
            });
        }

        return response()->json([
            'message' => 'Record Updated Successfully',
            'data' => $model->load('details')
        ], 200);
    }


    public function destroy($id)
    {

        $model = Blog::find($id);
        if(!$model){
            return response()->json(['message' => 'Record Not Found.'], 422);
        }

        $model->removeImage();
        $model->delete();

        return response()->json([
            'message' =>'Record deleted successfully.',
            'data' => $model,
        ], 200);

    }


}
