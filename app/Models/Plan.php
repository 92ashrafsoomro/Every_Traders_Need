<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plans';  // specify the actual table name

    protected $fillable = [
        'plan_name',
        'short_desc',
        'description',
        'icon',
        'price',
        'is_officer',
        'duration_unit',
        'duration_value'
    ];
}
