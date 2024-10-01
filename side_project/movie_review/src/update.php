<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/update.css">
    <script src="https://kit.fontawesome.com/f82e475176.js" crossorigin="anonymous"></script>
    <title>수정 페이지</title>
</head>
<body>
    <div class="container">
        <?php
            require_once(MY_PATH_HEADER);
        ?>

        <main>
            <div class="list">
                <div class="update-page_poster">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" name="file" id="file">
                        <button class="btn-style update-page_img_btn" type="submit">OK</button>
                    </form>
                    <img src="./img/parasite.png" class="update-page_img">
                </div>
                <div class="box-size content-box">
                    <input type="text" class="content-list" placeholder="기생충">
                    <input type="text" class="content-list" placeholder="5.0">
                    <textarea class="content-list" name="review" id="review" placeholder="재밋었다."></textarea>
                    <p class="content-list" style="text-align: center;"><img src="./img/basic/barcode.png" class="content-barcode"></p>
                </div>
            </div>
            <div class="main_footer">
                <a href="./detail.php"><button class="btn-style">완료</button></a>
                <a href="./detail.php"><button class="btn-style">취소</button></a>
            </div>
        </main>
    </div>
</body>
</html>