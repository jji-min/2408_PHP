<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
    require_once(MY_PATH_DB_LIB);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/main.css">
    <script src="https://kit.fontawesome.com/f82e475176.js" crossorigin="anonymous"></script>
    <title>메인 페이지</title>
</head>
<body>
    <div class="container">
        <?php
            require_once(MY_PATH_HEADER);
        ?>

        <main>
            <div class="main-page_insert_btn">
                <a href="./insert.php">
                    <button class="btn-style"><i class="fa-solid fa-plus"></i></button>
                </a>
            </div>
            <div class="list">
                <div class="main-page_poster">
                    <img src="./img/parasite.png" class="box-size">
                    <div class="img_display">
                        <div class="box-size box_hover_content">
                            <a href="./detail.php"><h2>기생충</h2></a>
                            <p class="star-group">
                                <i class="fa-solid fa-star star"></i>
                                <i class="fa-solid fa-star star"></i>
                                <i class="fa-solid fa-star star"></i>
                                <i class="fa-solid fa-star star"></i>
                                <i class="fa-regular fa-star star"></i>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="main-page_poster">
                    <img src="./img/parasite.png" class="box-size">
                    <div class="img_display">
                        <div class="box-size box_hover_content">
                            <a href="./detail.php"><h2>기생충</h2></a>
                            <p class="star-group">
                                <i class="fa-solid fa-star star"></i>
                                <i class="fa-solid fa-star star"></i>
                                <i class="fa-solid fa-star star"></i>
                                <i class="fa-solid fa-star star"></i>
                                <i class="fa-regular fa-star star"></i>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="main-page_poster">
                    <img src="./img/parasite.png" class="box-size">
                    <div class="img_display">
                        <div class="box-size box_hover_content">
                            <a href="./detail.php"><h2>기생충</h2></a>
                            <p class="star-group">
                                <i class="fa-solid fa-star star"></i>
                                <i class="fa-solid fa-star star"></i>
                                <i class="fa-solid fa-star star"></i>
                                <i class="fa-solid fa-star star"></i>
                                <i class="fa-regular fa-star star"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main_footer">
                <a href="./main.php"><button class="btn-style"><</button></a>
                <a href="./main.php"><button class="btn-style btn-selected">1</button></a>
                <a href="./main.php"><button class="btn-style">2</button></a>
                <a href="./main.php"><button class="btn-style">3</button></a>
                <a href="./main.php"><button class="btn-style">></button></a>
            </div>
        </main>
    </div>
</body>
</html>