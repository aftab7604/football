<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    const RECOMMENDED = ['YES' => 1, 'NO' => 0];
    const STATUS = ['NOT_PUBLISHED' => 0, 'PUBLISHED' => 1];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'subtitle', 'description', 'image', 'recommended', 'category_id', 'views', 'status'
    ];


    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
