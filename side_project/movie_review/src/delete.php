<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/delete.css">
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
                <img src="./img/parasite.png" class="delete-page_img">
                
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
                <a href="./main.php"><button class="btn-style">삭제</button></a>
                <a href="./detail.php"><button class="btn-style">취소</button></a>
            </div>
        </main>
    </div>
</body>
</html>