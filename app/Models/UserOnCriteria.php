<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\AsCollection;

class UserOnCriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'data',
        'increase',
        'criteria_id',
        'status',
        'states'
    ];

    protected $casts = [
        "states" => AsCollection::class
    ];

    public function criteria()
    {
        return $this->hasOne(Criteria::class, 'id', 'criteria_id');
    }
}
