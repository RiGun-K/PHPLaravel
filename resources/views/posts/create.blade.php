<!DOCTYPE html>
<html>
  <head>
    <title>안녕하세요. 반갑습니다.</title>
    <link rel='stylesheet' href="css/bootstrap.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="./js/login.js"></script>
  </head>
  <body>
    <h2> 게시글 작성 </h2>
    <form action="/posts/store" method="post" enctype="multipart/form-data"> 
    <!-- mothod="get" = form 안의 데이터를 posts 방식으로 /posts/store로 넘기겠다. -->  
    @csrf  
      <div class="form-group">
        
      <!-- 이때 store로 넘어갈때 Token하고 같이 넘어가도록 해야함 -->  
        <label for="title">제목</label>
        <input type="text" name="title" placeholder="제목을 입력하세요." value="{{ old('title') }}"> 
      
       <!-- title 작성에 대한 에러 메세지 설명-->
      @error('title')
          <div>{{ $message }} </div>
      @enderror
      </div>
      <div class="form-group">
        <label for="content">내용</label>
        <textarea class="content" name="content" cols="30" rows="3" placeholder="내용을 입력하세요." id="content" > {{ old('content') }} </textarea>   
       <!--({  }) 을 작성해줌으로써 하나의 에러가 나면 모든 작성란이 전부 지워지지 않도록 설정-->
      
      @error('content')
         <div>{{ $message }} </div>
      @enderror
      </div>
    <!-- name에 해당하는 title content 의 값을 key로 하여 입력받아 /posts/store로 넘기겠다. -->
    
      <div class="form-group">
        <label for="file">File<label>
        <input type="file" id="file" name="imageFile">

        @error('imageFile')
          <div>{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary" >작성</button>

    
       
    </form>
    
  

  </body>
</html>




    
   