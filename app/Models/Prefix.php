<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefix extends Model
{
    
    protected $table = 'prefixes';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'prefix_key',
        'prefix_value',
    ];
    
}
