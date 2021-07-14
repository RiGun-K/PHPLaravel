<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostUser extends Model
{
    use HasFactory;

    
    protected $table='post_user';
    // 테이블 'post_user'로 지정해준다.
    public $timestamps = false;
    //  If you do not want these columns to be automatically managed by Eloquent, 
    //  you should define a $timestamps property on your model with a value of false:
}
