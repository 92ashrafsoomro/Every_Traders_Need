<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class News extends Model
{
    

    protected $fillable = [
        'title',
        'category_id',
        'image',
        'description',
        'date',
        'created_by',
    ];

    protected $appends = [
        'image_preview',
    ];

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

    // The users who pinned this news
    // In the News model
    public function pinnedUsers()
    {
        return $this->belongsToMany(User::class, 'news_user_pins', 'news_id', 'user_id');
    }


    // The admin who created it
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
  public function category() {
        return $this->belongsTo(NewSCategory::class, 'category_id');
    }

}
