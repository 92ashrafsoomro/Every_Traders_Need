<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class AuctionPlatform extends Model
{
    protected $table = 'auction_platform';

    // protected $fillable = ['name'];
     protected $guarded = [];
     protected $appends = [
        'image_preview',
    ];




public function centers()
{
    return $this->hasMany(AuctionCenter::class, 'auction_platform_id');
}


    protected function imagePreview(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image ?  asset('/uploads/'.$this->image) : null
        );
    }
    



}
