<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
    require_once(MY_PATH_DB_LIB);

    $conn = null;
    try {
        $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;  // id 획득

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
                <img src="<?php echo $result["img"] ?>" class="insert-page_img">
                
                <div class="content-box">
                    <p class="content-list">기생충</p>
                    <p class="content-list">2024-09-30</p>
                    <div class="content-list rating">
                        <p>
                            <i class="fa-solid fa-star star"></i>
                            <i class="fa-solid fa-star star"></i>
                            <i class="fa-solid fa-star star"></i>
                            <i class="fa-solid fa-star star"></i>
                            <i class="fa-regular fa-star star"></i>
                        </p>
                        <p>4.0</p>
                    </div>
                    <p class="content-list review">재밋었다.</p>
                    <p class="content-list" style="text-align: center;"><img src="./img/basic/barcode.png" class="content-barcode"></p>
                </div>
            </div>
            <div class="main_footer">
                <a href="./update.php"><button class="btn-style">수정</button></a>
                <a href="./main.php"><button class="btn-style">취소</button></a>
                <a href="./delete.php"><button class="btn-style">삭제</button></a>
            </div>
        </main>
    </div>
</body>
</html>