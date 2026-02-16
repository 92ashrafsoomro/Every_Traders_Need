<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BodyType extends Model
{
    
    // protected $fillable = ['name'];
    protected $guarded = [];



    public function vehicle()
    {
        return $this->hasMany(Vehicle::class, 'body_id');
    }

    





}
