<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $table ='surveys';

    protected $fillable = [
        'title'
    ];
    public function questions(){
        return $this->hasMany('App\Models\Question', 'survey_id', 'id');
    }
}
