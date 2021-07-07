<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    
</head>
<body>
    
    <div class="container">
        <div class="m-5">
            <a href="{{ route('posts.index',['page'=>$page])}}">목록보기</a>
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
            <textarea class="form-control" name="content" id="content" cols="30" rows="5" readonly>{{ $post->content }}
            </textarea>
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
            value="{{ $post->user_id }}"
            >
        </div>

        <!-- 로그인 할 경우에만 수정,삭제 버튼이 보이도록 하여라 -->
    @auth
        <!-- 유저아이디가 게시글 작성자의 아이디가 같다면 -->
        @can('update',$post)
            <div class="flex">
                <button class="btn btn-warning" onclick="location.href='{{ route('post.edit', ['post'=>$post->id, 'page'=>$page]) }}'">수정</button>
                
            
                <form action="{{ route('post.delete', ['id'=>$post->id, 'page'=>$page]) }}" method="post">
                    @csrf
                    @method("delete")
                    <button type="submit" class= "btn btn-danger">삭제</button>
                </form>
                    
            </div>
        @endcan
    @endauth
        

    </div>
    
</body>
</html>