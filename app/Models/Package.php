<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages'; 

    protected $primaryKey = 'id'; 

    public $timestamps = true; 

    protected $fillable = [
        'plan_id',
        'title',
        'short_desc',
        'description',
        'price',
        'discount',
        'duration_unit',
        'duration_value',
        'status',
        'sort_by',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ✅ Relationship to plan
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    // ✅ Relationship to payment
    public function payment()
    {
        return $this->hasOne(MembershipPayment::class, 'membership_id');
    }
  
}
