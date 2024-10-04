<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
    require_once(MY_PATH_DB_LIB);
    require_once(MY_PATH_PRINT_STARS);

    $conn = null;
    try {
        $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;  // id 획득

        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;  // page 획득

        if($id < 1) {
            throw new Exception("파라미터 오류");
        }

        $conn = my_db_conn();

        $arr_prepare = [
            "id" => $id
        ];

        $result = my_reviews_select_id($conn, $arr_prepare);
    } catch(Throwable $th) {
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
    <link rel="stylesheet" href="./css/detail.css">
    <link rel="icon" href="./img/basic/slate.png">
    <script src="https://kit.fontawesome.com/f82e475176.js" crossorigin="anonymous"></script>
    <title>상세 페이지</title>
</head>
<body>
    <div class="container">
        <?php
            require_once(MY_PATH_HEADER);
        ?>
        <main>
            <div class="list">
                <img src="<?php echo $result["img"] ?>" class="detail-page_img">
                
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
                    <p class="content-list btn-group">
                        <button class="btn_thumbs" onclick="location.href='./good_cnt.php?id=<?php echo $id ?>&page=<?php echo $page ?>'"><i class="fa-solid fa-thumbs-up"></i> <?php echo $result["good"] ?></button>
                        <button class="btn_thumbs" onclick="location.href='./bad_cnt.php?id=<?php echo $id ?>&page=<?php echo $page ?>'"><i class="fa-solid fa-thumbs-down"></i> <?php echo $result["bad"] ?></button>
                    </p>
                    <p class="content-list" style="text-align: center;"><img src="./img/basic/barcode.png" class="content-barcode"></p>
                </div>
            </div>
            <div class="main_footer">
                <a href="./update.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button class="btn-style">수정</button></a>
                <a href="./main.php?page=<?php echo $page ?>"><button class="btn-style">취소</button></a>
                <a href="./delete.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button class="btn-style">삭제</button></a>
            </div>
        </main>
    </div>
</body>
</html>