<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title');
            $table->mediumText('content');
            $table->string('image')->nullable();
            // column 들을 생성시켜줌.
            // 제목,내용,이미지,글쓴    이 만들어주자
            
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            // user 테이블의 id를 참조한다
            // onDelete = 삭제되면 같이 삭제되라 
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
        // posts 가 존재하면 drop 시켜라
    }
}
