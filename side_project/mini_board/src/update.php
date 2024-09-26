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

        // Transaction Start
        $conn->beginTransaction();

        $arr_prepare = [
            "id" => $id
            ,"title" => $title
            ,"content" => $content
        ];

        my_board_update($conn, $arr_prepare);

        // commit
        $conn->commit();

        // detail page로 이동
        header("Location: /detail.php?id=".$id."&page=".$page);
        exit;   // 안써도 에러는 나지 않지만 불필요한 처리를 방지
    }
} catch(Throwable $th) {
    if(!is_null($conn) && $conn->inTransaction()) {
        $conn->rollBack();
    }
    // is_null($conn) -> transaction 실행안했는데 오류 났다고 rollback 할 수도 있음
    // inTransaction() -> transaction이 시작했으면 true, 이것까지 써주는 것이 정확함
    // 조건은 앞에서부터 체크하기 때문에 순서 주의
    // &&를 사용하는것이 if문을 중첩시키는 것보다 가독성이 좋음

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
        require_once(MY_PATH_ROOT."header.php");
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
                <!-- 해당 버튼에 detail.php로 연결하는 a테그를 주면 update를 실행하지 않고 바로 detail로 넘어감, 버튼 하나에 1개의 기능만 가능 -->
                <a href="/detail.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button type="button" class="btn-small">취소</button></a>
            </div>
        </form>
    </main>
</body>
</html>