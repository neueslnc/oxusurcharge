<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayMobileModel extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id', 'sms_body', 'taker_id','message_id','status_sms','type_sms'];

    protected $table = 'play_mobile';
    public function user_sender(){
        return $this->belongsTo(User::class,'sender_id','id');
    }
    public function user_taker(){
        return $this->belongsTo(User::class,'taker_id','id');
    }
   
    public function user_department_many(){
        return $this->hasMany(User::class,'id','taker_id');
    }
    public function date_create()
    {
        return $this->created_at->format('d-m-Y'); 
    }
}
