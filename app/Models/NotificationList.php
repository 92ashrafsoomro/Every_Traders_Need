<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationList extends Model
{
    protected $table = 'notifications_list';

    protected $fillable = [
        'name'
    ];
}