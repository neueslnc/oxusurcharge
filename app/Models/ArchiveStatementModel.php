<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArchiveStatementModel extends Model
{
    use HasFactory;

    protected $table = 'archive_statement_models';

    protected $fillable = [
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
        'unfulfilled',
        'updated_at',
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
