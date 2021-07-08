<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsController extends Controller {
    
    // 생성자 지정
    // 밑에 index() 부터 오는 모든것들은 middleware로 지정이 된다. = 즉 로그인화면 먼저 띄워준다 (사용자인증 먼저)
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index','show']);
        // 단 예외로(except) index,show는 그대로 보여준다. 
    }

    public function show(Request $request, $id) {
        // show(상세보기 페이지) 로 연결시켜서 id를 넘겨주어 받을 수 있다.
        
        $page = $request->page;
        $post = Post::find($id);
        

        return view('posts.show', compact('post', 'page'));
    }

    public function index() {
        // 방법 1)   $posts = Post::orderBy('created_at','desc')->get(); // 가장 최신글이 앞으로 오도록 설정
        //      1) = $posts = Post::latest()->get();   <-> oldest()->get();

        // 방법 2) $posts = Post::paginate(2);  = 한 페이지에 값을 2개만 준다.
        $posts = Post::latest()->paginate(5);
        // dd($posts); // died~ = 소스코드로 보기 

        return view('posts.index', ['posts'=>$posts]);

        // index 메소드 생성
        // post 테이블의 모든것을 조회해본다.
        // 보고싶으면 return 해준다.

        // dd($posts[0]->created_at);
        // // 첫번째 원소의 created 값을 찍어본다.
    }

    public function myposts() {

        // 현재 로그인한 사용자를 뽑아내고 -> posts()->paginate() = 페이지네이트까지 불러줘야 정상적으로 
        // 이름이 같으면 최신글이 앞으로 오도록 orderBy('title','asc')->orderBy('created_at','desc')
        // $posts = auth()->user()->posts()->orderBy('title','asc')->orderBy('created_at','desc')->paginate(5);
        
        // auth() = 전역함수 = 선언하지 않아도 바로바로 쓸 수 있다. 그 종류는 홈페이지에서 참고
        $posts = auth()->user()->posts()->latest()->paginate(5);

        return view('posts.index', compact('posts'));

        
        
        
    }

    public function create() {
        // dd('OK');
        return view('posts.create');
    }


    // 제출누르면 이 Request가 실행됨 title과 content 값을 받아서 input한다
    // store는 DB에 있는 데이터만 INSERT
    public function store(Request $request) {


         // 내가 원하는 데이터로 왔는지 점검할 수 있다. 그게 아니면 자동으로 Back 시켜줌 ( 해킹방지)
        $request->validate([
            'title' => 'required|min:3',    // 최소 3자는 적어야 한다.
            'content' => 'required',
            'imageFile' => 'image|max:2000'
            // 'file' => 'file' 이면 반드시 파일이 있어야 작성된다는 뜻 ! 

            // 이때 조건이 충족안되면 에러 메세지를 보내준다 ! 이 설정은 create.blade.php 에서 설정
        ]); 
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
        // File 처리 , 내가 원하는 파일시스템 상의 위치에 원하는 이름으로
        // 파일을 저장하고 그 파일 이름을 컬럼에 설정
        // $post->image = $fileName;
            // 로그인한 사용자의 user 객체를 준다. 마찬가지로 ctrl+i 해준다.
        $post->user_id = Auth::user()->id;      

        if ($request->file('imageFile')) { 
            $post ->image = $this -> uploadPostImage($request);
         }

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

    
    // id가 몇번글에 있는지 = '수정' form 클릭시 여기로 이동
    public function edit(Request $request, Post $post) {
        
        // $post = Post::find($id);
        // $post = Post::where('id',$id)->first();

        // 수정 폼 생성
        return view('posts.edit', ['post'=>$post, 'page'=>$request->page]);
        // 'post'라는 변수이름으로 객체에 접근 
    }

    // id만 받는것이 아니라 변경할 내용도 받아야 함 ! 그것을 Request 객체로 받자 
    // Request 객체는 Route 파라미터($id) 보다 앞에 와야함 !
    public function update(Request $request, $id) {
    
        // vaildation 설정
        $request->validate([
            'title' => 'required|min:3',    // 최소 3자는 적어야 한다.
            'content' => 'required',
            'imageFile' => 'image|max:2000'
        ]);
        
        // 이미지 파일 수정 (파일 시스템에서) 
        // = 수정하면 기존 남아있는 이미지 파일을 처리 또는 삭제 등 모든 변화를 처리해야 함
        // if($request->file('imageFile')) {
        //     $imagePath = 'public/images/'.$post->image;
        //     Storage::delete(imagePath);
        //     $post->image = $this->uploadPostImage($request);

        // }
        


        $post = Post::find($id);

        // Authorization. 즉 수정 권한이 있는지 검사
        // 즉, 로그인한 사용자와 게시글의 작성자가 같은지 체크
            // if (auth()->user()->id != $post->user_id) {
            //     abort(403);
            // }
        if($request->user()->cannot('update',$post)) {
            abort(403);
        }

        // 게시글을 DB에서 수정
        $post->title=$request->title;
        $post->content=$request->content;
        if ($request->file('imageFile')) { 
            $imagePath = 'public/images/'.$post->image;
            Storage::delete($imagePath);
            $request -> file('imageFile'); 
            $post -> image = $this -> uploadPostImage($request);
        }
        
        $post->save();

        return redirect()->route('post.show',['id'=>$id, 'page'=>$request->page]);


    }

    public function uploadPostImage($request)
    {
        $name = $request->file('imageFile')->getClientOriginalName(); 
        $extension = $request->file('imageFile')->extension();
        $nameWithoutExtension = Str::of($name)->basename('.'.$extension); // 이름.jpg 없앰
        $fileName = $nameWithoutExtension . '_' . time() . '.' . $extension;    // 파일이름만 저장
        $request->file('imageFile')->storeAs('public/images',$fileName);

        return $fileName;
    }

    // 요청시 id와 페이지도 받는다
    public function destroy(Request $request, $id) {
        // 게시글을 DB에서 삭제
        // 단, DB에서 삭제하기 전에 파일 시스템에서 이미지 파일을 삭제하자 

        $post = Post::findOrFail($id);  // id값을 찾는다 

        // Authorization. 즉 수정 권한이 있는지 검사
        // 즉, 로그인한 사용자와 게시글의 작성자가 같은지 체크
            // if (auth()->user()->id != $post->user_id) {
            //     abort(403);
            // }
        if($request->user()->cannot('delete',$post)) {
            abort(403);
        }


        $page = $request->page;
        // 이미지 파일이 있다면 삭제
        if ($post->image) {
            $imagePath = 'public/images/'.$post->image;
            Storage::delete($imagePath);  // public/images 에서 삭제 
        }

        $post->delete();    // DB에서 삭제

        return redirect()->route('posts.index', ['page'=>$page]);
        

    }
}