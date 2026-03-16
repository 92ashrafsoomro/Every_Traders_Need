<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
class BlogDetail extends Model
{
    use HasFactory;

    protected $table = 'blog_details';

    protected $fillable = [
        'blog_id',
        'title',
        'description',
        'image',
        'preview_image',
        'alignment'
    ];


    public function uploadSectionImage($file)
    {
        if (!$file) return;
        if ($this->image) {
            $oldPath = public_path('uploads/sections/' . $this->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }
        $fileName = time() . '_sec_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/sections'), $fileName);

        $this->image = $fileName;
        $this->preview_image = asset('uploads/sections/' . $this->image);
        $this->save();
    }
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}