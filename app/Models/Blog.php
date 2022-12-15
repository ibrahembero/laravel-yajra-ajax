<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable=['image','title','content','publish_date','status','created_at','updated_at'];
    protected $hidden = ['created_at','updated_at'];
}
