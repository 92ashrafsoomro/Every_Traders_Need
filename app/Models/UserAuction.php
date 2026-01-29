<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAuction extends Model
{

    protected $table = 'user_auctions'; 
    protected $fillable = [
        'user_id',
        'auction_id',
        'created_at',
    ];

    
}

