<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'reserve_id',
        'date',
        'score',
        'comment',
    ];

    public function reserve()
    {
        return $this->belongsTo(Reserve::class);
    }

}
