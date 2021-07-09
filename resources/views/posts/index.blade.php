<!DOCTYPE html>
      <html lang="en">
      <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta http-equiv="X-UA-Compatible" content="ie=edge">
          <title>Document</title>
     
    <title>안녕하세요. 반갑습니다.</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
  </head>
  <body>
    <div class="container mt-5 mb-5">
        <!-- 'dashboard' 이동버튼 생성 -->
        <a href="{{ route('dashboard') }}" class="btn btn-primary">처음으로</a>
        <h1>게시글 리스트</h1>
        <!-- 로그인 한 사용자면 나타나고 로그인 안하면 안보이도록 설정 s-->
        @auth
        <a href="/posts/create" class="btn btn-primary">
            게시글 작성
        </a>

        <a href="/posts/mypost" class="btn btn-primary">
            내가 쓴 글
        </a>     
        @endauth
        <!-- 게시글 작성 버튼 누르면 posts/create 로 이동 -->
        <ul class="list-group mt-3">
            @foreach($posts as $post)
            <!-- posts를 전달해주면 각각의 정보를 post 변수에 넣고 -->
            <li class="lists-group-item">
                <span>
                    <a href="{{ route('post.show', ['id'=>$post->id, 'page'=>$posts->currentPage()]) }}">    <!-- 상세보기 페이지 이동설정 -->
                        <!-- 들어가기전에 아이디가 있어야 하므로 $post에서의 id값으로 지정설정 해준다 --> 
                    제목 : {{ $post->title  }}
                    </a>
                </span>
                <!-- 전달하는 방식임 title 에 해당하는 값 -->
            
                {{-- <div>
                    내용 : {{ $post->content }}
                </div> --}}

                <div>
                <span>작성일시 : {{ $post->created_at->diffForHumans() }}
                    
                </span>
                <!-- 전달하는 방식임 content 에 해당하는 값 -->
                </div>
                <div>
                    <span>
                        조회수 : {{ $post->count }} {{ $post->count > 0 ? Str::plural('view', $post->count) : 'view' }}
                      <!-- 조회수가 0이면 '조회수' 글이 안뜨도록 -->
                    </span>
                </div>    
                <hr>
            </li>
            @endforeach
        </ul>
    <div class="mt-3">

        {{ $posts->links() }}    <!-- 페이지에 links생성 -->
    </div>

  </body>
</html>


