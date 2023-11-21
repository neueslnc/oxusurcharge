<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class NotificationUserModel extends Model
{
    use HasFactory;

    protected $table = "notification_user";

    protected $fillable = [
        'title',
        'message',
        'sender_id',
        'recipient_id',
        'status'
    ];

    public function date_create()
    {
        return $this->created_at->format('d.m.Y'); 
    }

    public function admin_send(){
        return $this->hasOne(User::class,'id','sender_id');
    }
    
    public function admin_user(){
        return $this->hasOne(User::class,'id','recipient_id');
    }
}

  
