<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
    require_once(MY_PATH_DB_LIB);
    require_once(MY_PATH_PRINT_STARS);

    $conn = null;

    try {
        if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET") {
            // GET 처리
            $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;  // id 획득

            $page = isset($_GET["page"]) ? (int)$_GET["page"] : 0;  // page 획득

            if($id < 1) {
                throw new Exception("파라미터 오류");
            }

            $conn = my_db_conn();

            $arr_prepare = [
                "id" => $id
            ];

            $result = my_reviews_select_id($conn, $arr_prepare);
        } else {
            // POST 처리
            $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;  // id 획득

            if($id < 1) {
                throw new Exception("파라미터 오류");
            }

            $conn = my_db_conn();

            $conn->beginTransaction();

            $arr_prepare = [
                "id" => $id
            ];

            my_reviews_delete_id($conn, $arr_prepare);

            $conn->commit();
            
            header("Location: /"."main.php");
            exit;
        }
    } catch(Throwable $th) {
        if(!is_null($conn) && $conn->inTransaction()) {
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
    <link rel="stylesheet" href="./css/delete.css">
    <link rel="icon" href="./img/basic/slate.png">
    <script src="https://kit.fontawesome.com/f82e475176.js" crossorigin="anonymous"></script>
    <title>삭제 페이지</title>
</head>
<body>
    <div class="container">
        <?php
            require_once(MY_PATH_HEADER);
        ?>

        <main>
            <div class="delete-page_coment">
                <p>삭제하면 영구적으로 복구할 수 없습니다.</p>
                <p>정말로 삭제 하시겠습니까?</p>
            </div>
            <div class="list">
                <img src="<?php echo $result["img"] ?>" class="delete-page_img">
                
                <div class="content-box">
                    <p class="content-list"><?php echo $result["title"] ?></p>
                    <p class="content-list"><?php echo $result["created_at"] ?></p>
                    <div class="content-list rating">
                        <p>
                            <?php echo print_stars($result); ?>
                        </p>
                        <p><?php echo $result["rating"] ?></p>
                    </div>
                    <p class="content-list review"><?php echo $result["review"] ?></p>
                    <p class="content-list" style="text-align: center;"><img src="./img/basic/barcode.png" class="content-barcode"></p>
                </div>
            </div>
            
            <form action="./delete.php" method="post">
                <input type="hidden" name="id" id="id" value="<?php echo $result["id"]?>">
                <input type="hidden" name="page" id="page" value="<?php echo $page ?>">
                <div class="main_footer">
                    <button type="submit" class="btn-style">삭제</button>
                    <a href="./detail.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button type="button" class="btn-style">취소</button></a>
                </div>
            </form>
        </main>
    </div>
</body>
</html>