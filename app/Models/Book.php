<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected  $table= 'books';
    protected $fillable=[
        'title',
        'description',
        'admin_id',
        'sold',
        'image',
        'price',
        'coin',
        'price_reduce',
        'coin_reduce',
        'discount'
    ];
    public function bookChapter(){
        return $this->hasMany('App\Models\BookChapter','book_id','id');
    }
}
