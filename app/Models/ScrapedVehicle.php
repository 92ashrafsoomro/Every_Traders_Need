<?php

namespace App\Models;
use App\Models\User;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScrapedVehicle extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'auction_id',
        'payload',
    ];
    
    public function auction()
    {
        return $this->belongsTo(Auctions::class,'auction_id');
    }


}
