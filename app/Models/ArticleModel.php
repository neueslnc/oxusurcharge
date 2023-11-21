<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ArticleModel extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'name',
        'article',
        'user_id',
        'status',
        'file',
        'web_addres',
    ];
    
    public function date_create()
    {
        return $this->created_at->format('d-m-Y'); 
    }

    
    public function teacher()
    {
        return $this->hasOne(User::class, 'id', 'user_id');    
    }

    public function abbreviated_article(){
        
        if (Str::length($this->article) > 50) {
            return Str::substr($this->article, 0, 50) . "...";
        }

        return $this->article;
    }
}
