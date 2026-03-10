<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';  // Table name

    protected $fillable = [
        'key',
        'value',
    ];

    public $timestamps = true; // created_at, updated_at
}