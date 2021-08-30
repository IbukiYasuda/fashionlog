<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    
    protected $fillable = [
    'title',
    'body',
    'image',
    'place',
    'price'
    ];
    
    
    public function getPaginate()
    {
        return $this->orderBy('updated_at', 'DESC')->paginate(8);
    }
    
    public function user() 
    {
        return $this->belongsTo('App\User');
    }
    
    public function tags() 
    {
        return $this ->belongsToMany('App\Tag');
    }
}
