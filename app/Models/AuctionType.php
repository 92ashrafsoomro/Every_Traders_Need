<?php

// app/Models/Auction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuctionType extends Model
{   

     protected $table = 'auction_types';

    protected $fillable = [
        'name',
    ];


}
