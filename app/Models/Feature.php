<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{

    protected $fillable = ['title'];



    // In Alert model
    public function plans() 
    {
        return $this->hasMany(PlanFeature::class, 'feature_id');
    }

}
