<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// Model의 기능들을 상속받아 쓰고있음.
class Post extends Model
{
    // protected $table = 'my_posts';
    // Post 테이블이 아닌 my_posts로 받는다.
    
    use HasFactory;
}
