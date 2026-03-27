<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';  

    protected $fillable = [
        'key',
        'value',
    ];
    public function getUrlAttribute()
    {
        return $this->value ? asset('uploads/' . $this->value) : null;
    }
    public $timestamps = true; 
}