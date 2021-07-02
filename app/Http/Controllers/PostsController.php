<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller {


    public function index() {
        // 방법 1)   $posts = Post::orderBy('created_at','desc')->get(); // 가장 최신글이 앞으로 오도록 설정
        //      1) = $posts = Post::latest()->get();   <-> oldest()->get();

        // 방법 2) $posts = Post::paginate(2);  = 한 페이지에 값을 2개만 준다.
        $posts = Post::latest()->paginate(5);

        return view('posts.index', ['posts'=>$posts]);

        // index 메소드 생성
        // post 테이블의 모든것을 조회해본다.
        // 보고싶으면 return 해준다.

        // dd($posts[0]->created_at);
        // // 첫번째 원소의 created 값을 찍어본다.
    }

    public function create() {
        // dd('OK');
        return view('posts.create');
    }


    // 제출누르면 이 Request가 실행됨 title과 content 값을 받아서 input한다
    // store는 DB에 있는 데이터만 INSERT
    public function store(Request $request) {
        // $request->input['title'];
        // $request->input['content'];
            // 1 ) 방법
            // 멤버함수에 접근할떄 -> 사용
    
        $title = $request->title;     // $request 에 있는 name=title 값을 받아서 $title로 만든다.
        $content = $request->content;
            // 2) 방법
    
        

            // DB에 저장
        $post = new Post();     // Ctrl+i+Tab
        $post->title = $title;
        $post->content = $content;

            // 내가 원하는 데이터로 왔는지 점검할 수 있다. 그게 아니면 자동으로 Back 시켜줌 ( 해킹방지)
        $request->validate([
            'title' => 'required|min:3',    // 최소 3자는 적어야 한다.
            'content' => 'required'

            // 이때 조건이 충족안되면 에러 메세지를 보내준다 ! 이 설정은 create.blade.php 에서 설정
        ]);       

            // 로그인한 사용자의 user 객체를 준다. 마찬가지로 ctrl+i 해준다.
        $post->user_id = Auth::user()->id;      

        $post->save();  
            // 메소드 이므로 () 묶는다.


        // 결과 뷰를 반환 
        return redirect('/posts/index');

        /*
        $posts = Post::paginate(5);
        return view('posts.index',['posts'=>$posts]); 
        = 새로고침하면 DB에 동일한 Data가 매번 저장됨
        */

        
    }
}