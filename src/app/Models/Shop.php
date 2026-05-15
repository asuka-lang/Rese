<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable =[
        'title','area_id', 'genre_id',
        'manager_id', 'information', 'image'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reserve()
    {
        return $this->hasMany(Reserve::class);
    }

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function scopeAreaSearch($query,$area_id)
    {
        if(!empty($area_id)){
            $query->where('area_id',$area_id);
        }
    }

    public function scopeGenreSearch($query,$genre_id)
    {
        if(!empty($genre_id)){
            $query->where('genre_id',$genre_id);
        }
    }

    public function scopeKeywordSearch($query,$keyword)
    {
        if(!empty($keyword)){
            $query->where('title','like','%'. $keyword .'%');
        }
    }

}
