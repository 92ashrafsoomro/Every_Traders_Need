<?php

namespace App\Http\Resources;

use App\Models\Membership;
use App\Models\Role;
use App\Models\UserDevice;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Request;

class UserProfileResource extends JsonResource
{

    public function toArray($request)
    {

        $current = Membership::where('user_id',$this->id)
        ->with(['plan'])
        ->where('membership_status', 'Active')
        ->whereDate('membership_start_date', '<=', now())
        ->whereDate('membership_expiry_date', '>=', now())
        ->first();

        $role = Role::find($this->user_type);

        return [
            'id'                => $this->id,
            'user_type'         => $this->user_type,
            'role'              => $role ? $role->name : 'User',
            'firstName'         => $this->firstName,
            'status'            => $this->status,
            'avatar' => $this->avatar ? env('APP_URL') . 'public/uploads/avatar/' . $this->avatar: null,
            'source' => $this->source,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'plan' => $current,  
        ];

    }

    
}
