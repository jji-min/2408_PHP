<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

try {

} catch(Throwable $th) {
    
}

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/delete.css">
    <title>삭제 페이지</title>
</head>
<body>
    <header>
        <h1>Mini Board</h1>
    </header>
    <main>
        <div class="main-header">
            <p>삭제하면 영구적으로 복구할 수 없습니다.</p>
            <p>정말로 삭제 하시겠습니까?</p>
        </div>
        <div class="main-content">
            <div class="box">
                <div class="box-title">게시글 번호</div>
                <div class="box-content">30</div>
            </div>

            <div class="box">
                <div class="box-title">제목</div>
                <div class="box-content">게시글 제목30</div>
            </div>
                
            <div class="box">
                <div class="box-title">내용</div>
                <div class="box-content">내용30</div>
            </div>

            <div class="box">
                <div class="box-title">작성일자</div>
                <div class="box-content">2024-01-01 10:53:20</div>
            </div>
        </div>

        <div class="main-footer">
            <a href="./index.html"><button type="button" class="btn-small">동의</button></a>
            <a href="./detail.html"><button type="button" class="btn-small">취소</button></a>
        </div>
    </main>
</body>
</html>