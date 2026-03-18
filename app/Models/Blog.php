<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\File;


class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','slug', 'image', 'description', 'date', 'author_id',
        'category_id', 'tag', 'meta_title', 'meta_description',
        'meta_keyword', 'slug', 'status'
    ];
    
    protected $appends = [
        'image_preview',
    ];

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category() {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }


      protected function imagePreview(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image ?  asset('/uploads/'.$this->image) : null
        );
    }


      public function updateImage($file)
    {
        if (!$file) {
            return;
        }

        // Remove old image
        if ($this->getRawOriginal('image')) {
            $oldPath = public_path('uploads/' . $this->getRawOriginal('image'));
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

        // Save new image
        $fileName = time() . '__ff__' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);

        $this->image = $fileName;
        $this->save();
    }
    

     public function removeImage()
    {
        if ($this->getRawOriginal('image')) {
            $path = public_path('uploads/' . $this->getRawOriginal('image'));

            if (File::exists($path)) {
                File::delete($path);
            }

            $this->image = null;
            $this->save();
        }
    }

    public function details()
    {
        return $this->hasMany(BlogDetail::class, 'blog_id', 'id');
    }


}
