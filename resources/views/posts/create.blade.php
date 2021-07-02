<!DOCTYPE html>
<html>
  <head>
    <title>안녕하세요. 반갑습니다.</title>
  </head>
  <body>
    <div>회원가입 및 로그인</div>
    <form action="/posts/store" method="post"> 
    <!-- mothod="get" = form 안의 데이터를 posts 방식으로 /posts/store로 넘기겠다. -->  

    @csrf
    <!-- 이때 store로 넘어갈때 Token하고 같이 넘어가도록 해야함 -->  
      
    
       <input type="text" name="title" placeholder="Title" value="{{ old('title') }}"> 

       <!-- title 작성에 대한 에러 메세지 설명-->
      @error('title')
          <div>{{ $message }} </div>
      @enderror

       <textarea type="content" name="content" cols="30" rows="10" > "{{ old('content') }}" </textarea>   
       <!-- {{ old('') }} 을 작성해줌으로써 하나의 에러가 나면 모든 작성란이 전부 지워지지 않도록 설정-->

      @error('content')
         <div>{{ $message }} </div>
      @enderror

    <!-- name에 해당하는 title content 의 값을 key로 하여 입력받아 /posts/store로 넘기겠다. -->
    
       <input type="submit" value="Submit"> 
    
       
    </form>


  </body>
</html>




    
   