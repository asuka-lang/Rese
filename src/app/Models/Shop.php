<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable =[
        'title','area', 'genre', 'information', 'image'
    ];

    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }

    public function scopeAreaSearch($query,$area)
    {
        if(!empty($area)){
            $query->where('area',$area);
        }
    }

    public function scopeGenreSearch($query,$genre)
    {
        if(!empty($genre)){
            $query->where('genre',$genre);
        }
    }

    public function scopeKeywordSearch($query,$keyword)
    {
        if(!empty($keyword)){
            $query->where('title','like','%'. $keyword .'%');
        }
    }

}
