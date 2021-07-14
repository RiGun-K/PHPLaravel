<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $users = null;
    protected $posts = null;    // 일단 초기화

    public function __construct()   // 객체 생성될때
    {
        parent::__construct();              // 부모 생성자 불러준다.
        $this->users = User::all();        // 유저값 다 가지고 온다.
        $this->users = Post::all();
    }
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    // 더미 데이터이기 때문에 
    public function definition()
    {
        return [
            'title' => $this->faker->text(10),
        'content' => $this->faker->sentence(),
            // 'user_id' => 1  / 사용자가 1로 설정

            // 'user_id' => $this->users->random()->id, / 랜덤으로 아이디 가지고온다.

            
            'user_id' => User::factory()->create()->id,
        ];
    }
}
