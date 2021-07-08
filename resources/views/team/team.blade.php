<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>team</title>
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

        <!-- 부가적인 테마 -->
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

        <!-- 자바스크립트 -->
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

        <style>
            .Bbody {
                padding: 3%;
            }

            .BigName {
                text-align: center;
            }
            .write{
                width: fit-content;
                height: fit-content;
                border-radius: 3% solid black;
            }

        </style>

        <h1 class="BigName">팀프로젝트할거야</h1>

    </head>
    <body>
        <div class="Bbody">
            <!-- 썸네일 -->

            <!-- 동그라미 이미지 -->
            <img src="..." alt="이미지로드실패" class="img-circle">

            <!-- 네비게이션바 -->
            <!-- 고정적으로 파란색 칠해져있도록 설정하는법 : class="active" -->
            <ul class="nav nav-tabs">
                <li role="presentation" class="active">
                    <a href="http://www.naver.com">Home</a>
                </li>
                <li role="presentation">
                    <a href="#">Profile</a>
                </li>
                <li role="presentation">
                    <a href="#">Messages</a>
                </li>
            </ul>

            <!-- 링크있는 항목 -->
            <div class="list-group">
                <a href="#" class="list-group-item active">
                    Cras justo odio
                </a>
                <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
                <a href="#" class="list-group-item">Morbi leo risus</a>
                <a href="#" class="list-group-item">Porta ac consectetur ac</a>
                <a href="#" class="list-group-item">Vestibulum at eros</a>
            </div>

            <!-- 진행도 그래프 -->
            <div class="progress">
                <div
                    class="progress-bar"
                    role="progressbar"
                    aria-valuenow="2"
                    aria-valuemin="0"
                    aria-valuemax="100"
                    style="min-width: 2em; width: 70%;">
                    70%
                </div>
            </div>

            <!-- 경로 -->
            <ol class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Library</a>
                </li>
                <li class="active">Data</li>
            </ol>

            <!-- 폼 -->
            <form class="write">
                <div class="form-group">
                    <label for="exampleInputEmail1">이메일 주소</label>
                    <input
                        type="email"
                        class="form-control"
                        id="exampleInputEmail1"
                        placeholder="이메일을 입력하세요">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">암호</label>
                    <input
                        type="password"
                        class="form-control"
                        id="exampleInputPassword1"
                        placeholder="암호">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">파일 업로드</label>
                    <input type="file" id="exampleInputFile">
                    <p class="help-block">여기에 블록레벨 도움말 예제</p>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox">
                        입력을 기억합니다
                    </label>
                </div>
                <button type="submit" class="btn btn-default">제출</button>
            </form>

        </div>
    </body>
</html>