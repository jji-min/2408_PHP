<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

try {
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET") {
        // GET 처리

        // id 획득
        $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

        // page 획득
        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;

        if($id < 1) {
            throw new Exception("파라미터 오류");
        }

        // PDO Instance
        $conn = my_db_conn();

        // -------------------
        // 데이터 조회
        // -------------------
        $arr_prepare = [
            "id" => $id
        ];

        $result = my_board_select_id($conn, $arr_prepare);
        
    } else {
        // POST 처리

        // ----------------------
        // parameter 획득
        // ----------------------
        // id 획득
        $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;

        // page 획득
        $page = isset($_POST["page"]) ? (int)$_POST["page"] : 1;

        // title 획득
        $title = isset($_POST["title"]) ? $_POST["title"] : "";

        // content 획득
        $content = isset($_POST["content"]) ? $_POST["content"] : "";

        if($id < 1 || $title === "") {
            throw new Exception("파라미터 오류");
        }

        // PDO Instance
        $conn = my_db_conn();

        $arr_prepare = [
            "id" => $id
            ,"title" => $title
            ,"content" => $content
        ];

        // Transaction Start
        $conn->beginTransaction();
        my_board_update($conn, $arr_prepare);

        $conn->commit();

        header("Location: /detail.php?id=$id&page=$page");
    }
} catch(Throwable $th) {
    if(!is_null($conn)) {
        $conn->rollBack();
    }
    require_once(MY_PATH_ERROR);
    exit;
}

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/update.css">
    <title>수정 페이지</title>
</head>
<body>
    <?php
        require_once(MY_PATH_ROOT."/header.php");
    ?>

    <main>
        <form action="/update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $result["id"] ?>">
            <input type="hidden" name="page" value="<?php echo $page ?>">
            <!-- 화면에는 나오지 않음, 이 값이 필요하지만 화면에 나오지 않게 하기 위해 사용 -->

            <div class="box title-box">
                <div class="box-title">글번호</div>
                <div class="box-content"><?php echo $result["id"] ?></div>
            </div>
            <div class="box title-box">
                <div class="box-title">제목</div>
                <div class="box-content">
                    <input type="text" name="title" id="title" value="<?php echo $result["title"] ?>">
                </div>
            </div>
            <div class="box content-box">
                <div class="box-title">내용</div>
                <div class="box-content">
                    <textarea name="content" id="content"><?php echo $result["content"] ?></textarea>
                </div>
            </div>
            <div class="main-footer">
                <button type="submit" class="btn-small">완료</button>
                <a href="/detail.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button type="button" class="btn-small">취소</button></a>
            </div>
        </form>
    </main>
</body>
</html>