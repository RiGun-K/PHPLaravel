<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    
</head>
<body>
    
    <div class="container">
        <div class="mt-4" m-3>
            <a href="{{ route('posts.index',['page'=>$page])}}" class="btn btn-primary" >목록보기</a>
        </div>
        <div class="form-group">
            <label for="title">제목</label>
            <input type="text" readonly
            name="title" class="form-control" id="title"
            value="{{ $post->title }}"     
            >
        </div>

        <div class="form-group">
            <label for="content">내용</label>
            <div name="content" id="content"  readonly> {!! $post->content !!} </div>
        </div>
        

        <div class="form-group">
            <label for="imageFile">사진</label>
            {{-- <div class="img-thumbnail" width="20%">
                <img src="/storage/images/{{ $post->image ?? 'no_image.jpeg' }}" /> --}}
            
            <img class="img-thumbnail"
                width="20%"
                src="{{ $post->imagePath() }}" />
            
            
        </div>

        <div class="form-group">
            <label>등록일</label>
            <input type="text" readonly
            class="form-control"
            value="{{ $post->created_at->diffForHumans() }}"
            >
        </div>
        <div class="form-group">
            <label>수정일</label>
            <input type="text" readonly
            class="form-control"
            value="{{ $post->updated_at }}"
            >
        </div>
        <div class="form-group">
            <label>작성자</label>
            <input type="text" readonly
            class="form-control"
            value="{{ $post->user->name }}"
            >
        </div>

    </div>    
        <!-- 로그인 할 경우에만 수정,삭제 버튼이 보이도록 하여라 -->
    <div class="container mt-3">    
        @auth
        <!-- 유저아이디가 게시글 작성자의 아이디가 같다면 -->
            @can('update',$post)
                <div class="flex">
                    <div>
                        <a class="btn btn-warning" href='{{ route('post.edit', ['post'=>$post->id, 'page'=>$page]) }}'>수정</a>
                        
                    </div>
                    <div>
                        <form action="{{ route('post.delete', ['id'=>$post->id, 'page'=>$page]) }}" method="post">
                            @csrf
                            @method("delete")
                            <button type="submit" class= "btn btn-danger">삭제</button>
                        </form>
                    </div>    
                </div>
            @endcan
        @endauth
    </div>    
    
    
</body>
</html>