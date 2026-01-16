<?php

// app/Models/Auction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuctionStatus extends Model
{   

    protected $table = 'auction_status';

    protected $fillable = [
        'id',
        'title',
    ];


}
