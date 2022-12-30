<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  use HasFactory;
  protected $table = 'courses';
  protected $fillable = [
    'title',
    'description',
    'sold',
    'image',
    'video',
    'admin_id',
    'admin_name',
    'discount',
    'price',
    'coin',
    'price_reduce',
    'coin_reduce',
    'view',
    'type',
    'category_id',
    'opening_date',
    'application',
    'password',
  ];
}