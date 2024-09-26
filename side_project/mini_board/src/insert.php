<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

// post 처리
// $_SERVER의 REQUEST_METHOD : user가 보내온 값이 GET인지 POST인지 알수 있음
if(strtoupper($_SERVER["REQUEST_METHOD"]) === "POST") {  // 혹시 소문자로 올 수 있으니까 처리를 해줌
    try {
        // PDO Instance
        $conn = my_db_conn();

        // --------------------
        // insert 처리
        // --------------------
        $arr_prepare = [
            "title" => $_POST["title"]
            ,"content" => $_POST["content"]
        ];

        // begin transaction
        $conn->beginTransaction();  // insert 하다가 오류나면 rollback 해야하기 때문에 transaction해야함
        my_board_insert($conn, $arr_prepare);

        $conn->commit();

        header("Location: /");  // header("Location: /") : 내장함수, html의 head안에 Location을 추가하는 것
        exit;
    } catch(Throwable $th) {
        if(!is_null($conn)) {
            $conn->rollBack();
        }
        require_once(MY_PATH_ERROR);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/insert.css">
    <title>작성 페이지</title>
</head>
<body>
    <?php 
        require_once(MY_PATH_ROOT."header.php");
    ?>

    <main>
        <form action="/insert.php" method="post">
            <div class="box title-box">
                <div class="box-title">제목</div>
                <div class="box-content">
                    <input type="text" name="title" id="title">
                </div>
            </div>
            <div class="box content-box">
                <div class="box-title">내용</div>
                <div class="box-content">
                    <textarea name="content" id="content"></textarea>
                </div>
            </div>
            <div class="main-footer">
                <button type="submit" class="btn-small">작성</button>
                <a href="/"><button type="button" class="btn-small">취소</button></a>
            </div>
        </form>
    </main>
</body>
</html>