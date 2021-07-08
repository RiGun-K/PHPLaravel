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

    public function imagePath() {
        // $path = '/storage/images';
        $path = env('IMAGE_PATH', '/storage/images/');
        $imageFile = $this->image ?? 'no_image.jpeg';
        return $path.$imageFile;
    }

    public function user() {
        // $this (나)는 -> User 클래스 (users 테이블)의 정보가 오도록 호출한다.
        // 내부적으로 JOIN을 한다.
        return $this->belongsTo(User::class);

    }
}
