<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_user', function (Blueprint $table) {

            // post 와 user 테이블에 해당하는 foregien 키를 주자. = laravel->db->mirgate->foreigen에서 찾을 수 있다.
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelte('cascade');  
            // user_id가 constrained (알아서 무엇을 참고하고 하는지 해준다.) , onDelete(삭제되면 같이 삭제해준다.)
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->timestamp('created_at');
            // s 지우고 create_at (언제 조회했는지)  를 사용하여 시간정보를 추출할 수 있도록 설정
            $table->unique(['user_id', 'post_id']);
            // 유니크 설정 = 동일한 id로 중복되지 않도록 설정해준다.
            // insert(['user_id'=>1, 'post_id'=>1]); 하고 또 1,1 을 줄 수가 없다 (중복 X)
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_user');
    }
}
