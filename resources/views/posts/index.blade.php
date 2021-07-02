<!DOCTYPE html>
<html>
  <head>
    <title>안녕하세요. 반갑습니다.</title>
  </head>
  <body>
    <div class="container mt-5 mb-5">
        <!-- 'dashboard' 이동버튼 생성 -->
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <h1>게시글 리스트</h1>
        <!-- 로그인 한 사용자면 나타나고 로그인 안하면 안보이도록 설정 s-->
        @auth
        <a href="/posts/create" class="btn btn-primary">
            게시글 작성
        </a>
        @endauth
        <!-- 게시글 작성 버튼 누르면 posts/create 로 이동 -->
        <ul class="list-group mt-3">
            @foreach($posts as $post)
            <!-- posts를 전달해주면 각각의 정보를 post 변수에 넣고 -->
            <li class="lists-group-item">
                <span>제목 : {{ $post->title  }}</span>
                <!-- 전달하는 방식임 title 에 해당하는 값 -->
            
                <div>
                    내용 : {{ $post->content }}
                </div>
                <span>작성자 : {{ $post->created_at }}</span>
                <!-- 전달하는 방식임 content 에 해당하는 값 -->
                <hr>
            </li>
            @endforeach
        </ul>
    </div class="mt-5">

        {{ $posts->links() }}    <!-- 페이지에 links생성 -->


  </body>
</html>


