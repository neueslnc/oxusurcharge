<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AnnouncementModel extends Model
{
    use HasFactory;

    protected $table = 'announcements';

    protected $fillable = [
        'time',
        'theme',
        'pair',
        'group',
        'group_name',
        'subject',
        'user_id',
        'status',
        'description',
        'location',
        'created_at',
        'date',
        'unfulfilled'
    ];
    
    protected $casts = [
        'date' => "immutable_date:d.m.Y"
    ];

    public function teacher()
    {
        return $this->hasOne(User::class, 'id', 'user_id');    
    }

    public function date_create()
    {
        return $this->created_at->format('d.m.Y'); 
    }

    public function date_format()
    {
        $date = Carbon::parse($this->date);

        return $date->format('d.m.Y');
    }
}
