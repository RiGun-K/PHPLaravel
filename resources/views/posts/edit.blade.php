<!DOCTYPE html>
<html>
  <head>
    <title>안녕하세요. 반갑습니다.</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
  </head>
  <body>
    
  <div class="container">
    <h2> 게시글 수정 </h2>
    <!-- mothod="get" = form 안의 데이터를 posts 방식으로 /posts/store로 넘기겠다. -->  
    <form action="{{ route('post.update',['id'=>$post->id, 'page'=>$page]) }}" method="post" enctype="multipart/form-data"> 

      @csrf
      
      @method("put")
      {{-- mothod spoofing --}}
      
        <div class="form-group">
          
        <!-- 이때 store로 넘어갈때 Token하고 같이 넘어가도록 해야함 -->  
          <label for="title">제목</label>
          <input type="text" name="title" class="form-control" id="title" placeholder="제목을 입력하세요." value="{{ old('title') ? old('title') : $post->title }}"> 
        
        <!-- title 작성에 대한 에러 메세지 설명-->
        @error('title')
            <div>{{ $message }} </div>
        @enderror
        </div>

        <div class="form-group">
          <label for="content">내용</label>
          <textarea class="form-control" name="content" id="content" row="5" placeholder="내용을 입력하세요.">  {{ old('content') ? old('content') : $post->content }} </textarea>    
        <!--({  }) 을 작성해줌으로써 하나의 에러가 나면 모든 작성란이 전부 지워지지 않도록 설정-->
        
        @error('content')
          <div>{{ $message }} </div>
        @enderror

        </div>
      <!-- name에 해당하는 title content 의 값을 key로 하여 입력받아 /posts/store로 넘기겠다. -->
        <div class="form-group">
            <img class="img-thumbnail" width="20%" src="{{ $post->imagePath() }}">
        </div>

        <div class="form-group">
          <label for="file"><label>
          <input type="file" id="file" name="imageFile">

          @error('imageFile')
            <div>{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary" >작성</button>

    
       
    </form>
    
  
  </div>  
</body>
</html>


