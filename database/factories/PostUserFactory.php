<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostUserFactory extends Factory
{

    protected $user = null;
    protected $post = null;
    public function __construct()
    {
        parent::__construct();
        $this->users = User::all();
        $this->posts = Post::all();   
    }
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        do {    
            $userId = $this->users->random()->id;
            $postId = $this->posts->random()->id;   // postId는 랜덤으로 받는다.
            $postUser = PostUser::where('user_id', $userId)->where('post_id', $postId);
            // PostUser 테이블에서의 값 추가는 기존 저장된 userId와 postId 값중에서 받는다.
        } while($postUser->count()!=0);
            
        return [
                'user_id' => $userId,
                'post_id' => $postId,
        ];
    }
}
