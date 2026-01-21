<?php

namespace App\Models;
use App\Models\User;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskManagement extends Model
{
    use HasFactory;

    protected $table = 'task_managements';
    protected $fillable = [
        'id',
        'title',
        'auction_type',
        'platform',
        'auction_name',
        'date',
        'pak_time',
        'lots',
        'scr_lots',
        'status',
        'assign_to',
        'final_sheet',
        'notes',
        'created_by',
        'created_at',
        'updated_at',
    ];


    public function auctionHouse()
{
    return $this->belongsTo(AuctionPlatform::class,'platform');
}

public function user()
{
    return $this->belongsTo(User::class);
}

public function auctionType()
{
    return $this->belongsTo(AuctionType::class,'auction_type');
}


}
