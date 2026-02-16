<?php

// app/Models/Auction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auctions extends Model
{
    protected $fillable = [
        'name',
        'table_id',
        'auction_date',
        'end_date',
        'auction_type',
        'platform_id',
        'status',
        'csv_path'
    ];

    public function platform()
    {
        return $this->belongsTo(AuctionPlatform::class);
    }

    public function center()
    {
        return $this->belongsTo(AuctionCenter::class);
    }

     public function vehicle()
    {
        return $this->hasMany(Vehicle::class,'auction_id');
    }

    public function auctionType()
    {
        return $this->belongsTo(AuctionType::class,'auction_type');
    }
     public function auctionStatus()
    {
        return $this->belongsTo(AuctionStatus::class,'status');
    }

      public function scrap()
    {
        return $this->hasOne(ScrapedVehicle::class,'auction_id');
    }
    
}
