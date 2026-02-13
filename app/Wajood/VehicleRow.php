<?php

namespace App\Wajood;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Wajood\VehicleMain;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


    class VehicleRow 
{

    public $item = [];
    public $main;

    public $make = null;
    public $model = null;
    public $variant = null;


   
    public function __construct(VehicleMain $main,$item){
        
        $this->main = $main;
        $this->item = $item;

    }

    
    public function get(){
        
        $this->item['body_id']  = (new BodyTypeField($this))->get();
        $this->item['make_id']  = (new MakeField($this))->get();
        $this->item['model_id'] = (new ModelField($this))->get();
        $this->item['vairant_id'] = (new VariantField($this))->get();
        return $this->item;

    }


       
}
