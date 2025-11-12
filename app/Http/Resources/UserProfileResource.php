<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Request;

class UserProfileResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'name' => $this->title,
            'email' => $this->personalEmail,
            'phone' => $this->phone,
            'user_type' =>  $this->user_type == 0 ? 'Admin' : 'User',
            'avatar' => ENV('APP_URL').'public/uploads/avatar/'.$this->avatar,
            'status' => $this->status,
            'email_verification_token_status' => $this->email_verification_token_status,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
