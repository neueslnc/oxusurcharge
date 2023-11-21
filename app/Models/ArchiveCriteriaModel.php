<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveCriteriaModel extends Model
{
    use HasFactory;

    protected $table = 'archive_criteria';

    protected $fillable = [
        'user_id',
        'data',
        'increase',
        'criteria_id',
        'status',
        'states',
        'created_at',
        'updated_at'
    ];
}
