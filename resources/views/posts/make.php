<x-app-layout>
    <x-slot name="header">
       
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    
         여기는 회의록 작성 페이지에요~
         <img
         class="logo"
         alt="사진없어여"
         src="/image/HatchfulExport-All/logo_transparent.png">
     <form
         action="/projectStore"
         method="post"
         enctype="multipart/form-data"
         onkeydown="return event.key !='Enter';">
         @csrf

         <div class="form-group">
             <label for="exampleFormControlSelect1">프로젝트 명을 선택해 주세요.</label>
             <select class="form-control" name="people" id="exampleFormControlSelect1">
                 <option>1</option>
             </select>
         </div>

         <br>

         <div>
             <div class="form-group">
                 <label for="exampleFormControlTextarea1">오늘 회의 할 내용</label>
                 이전 회의록의 다음 회의할 회의 내용을 받아와서 출력
             </div>
             <br>
                <!-- 회의내용 -->
                <div class="form-group">
                 <label for="exampleFormControlTextarea1">회의 내용</label>
                 <textarea
                     class="form-control"
                     name="outline"
                     id="exampleFormControlTextarea1"
                     rows="3"></textarea>
             </div>


             <!-- 다음 회의할 내용 -->
             <div class="form-group">
                 <label for="exampleFormControlTextarea1">다음 회의 내용</label>
                 <textarea
                     class="form-control"
                     name="outline"
                     id="exampleFormControlTextarea1"
                     rows="3"></textarea>
             </div>

             <!-- 첨부파일 -->
             <div class="form-group">
                 <label for="exampleFormControlFile1">Example file input</label>
                 <input
                     type="file"
                     name="files[]"
                     class="form-control-file"
                     id="exampleFormControlFile1">
             </div>

             <div onclick="checkPlus()">체크리스트 생성</div>

             <button type="button" class="btm_image" id="img_btn" onclick="checkPlus()">
     
                 <img src="\image\icon\list_add_black_1x.png">
     
             </button>
             <div class="checkList">
     
                 <div class="form-check" id="check_plus"></div>
     
             </div>
             <br>
     
             <div id="plusDiv"></div>
             <button type="submit" class="btn btn-primary">저장</button>
             </form>

         </div>

         <button type="submit" class="btn btn-primary">저장 후 팀원들에게 회의록 보내기</button>
     </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function enterkey() {
        if (window.event.keyCode == 13) {
            divPlus();
            
            $('input').remove("#rewrite");
        
        }
    }
    function divPlus() {
        let title = document
            .getElementById('rewrite')
            .value;
        // 체크리스트에 추가 코드
        let temp_html = `  <div class="form-check">
                            <input class="form-check-input" name="lists[]" type="checkbox" checked value="${title}" id="goCheck">
                            <label class="form-check-label" for="defaultCheck1">
                                ${title}
                            </label>
                            </div>
                        `;
        $('#check_plus').append(temp_html)
        // 텍스트 아리아 포함 추가 코드
        let temp_html_div = `<label class="form-check-label" for="defaultCheck1">
                                ${title}
                        </label>
                        <br>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <br>
                        `;
        $('#plusDiv').append(temp_html_div)
    };
</script>