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
      <h2> 게시글 작성 </h2>
            <form action="/posts/store" method="post" enctype="multipart/form-data"> 
            <!-- mothod="get" = form 안의 데이터를 posts 방식으로 /posts/store로 넘기겠다. -->  
            @csrf
            <div class="mb-3">  
              <!-- 이때 store로 넘어갈때 Token하고 같이 넘어가도록 해야함 -->  
                <label for="exampleFormControlInput1" class="form-label">제목</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="제목을 입력하세요." value="{{ old('title') }}">
                
                
              
               <!-- title 작성에 대한 에러 메세지 설명-->
              @error('title')
                  <div>{{ $message }} </div>
              @enderror
              </div>

            
              <div class="mt-3 mb-3">
                <label for="exampleFormControlInput1" class="form-label" >내용</label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="5">{{ old('content') }}</textarea>
                <!--({  }) 을 작성해줌으로써 하나의 에러가 나면 모든 작성란이 전부 지워지지 않도록 설정-->
              
            
               
              @error('content')
                 <div>{{ $message }} </div>
              @enderror
              </div>
            <!-- name에 해당하는 title content 의 값을 key로 하여 입력받아 /posts/store로 넘기겠다. -->
            
           


              <div class="input-group mb-3">
                <input  type="file" class="form-control" id="file" name="imageFile">
                

                @error('imageFile')
                  <div>{{ $message }}</div>
                @enderror
              </div>
        
              <button type="submit" class="btn btn-primary" >작성</button>
        
            
               
            </form>
            
          
        
          </body>
</html>




    
   