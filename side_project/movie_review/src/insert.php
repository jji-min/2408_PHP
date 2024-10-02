<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
    require_once(MY_PATH_DB_LIB);

    $conn = null;
    
    // POST 처리
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "POST") {
        try {
            $conn = my_db_conn();

            $file = $_FILES["file"];

            $conn->beginTransaction();

            // 이미지 이름 중복을 방지 하기 위해 랜덤이름으로 이미지를 저장함
            $file_type = $_FILES["file"]["type"];
            // 파일의 mime 형식. 예를 들면 "image/gif"
            $file_type_array = explode("/", $file_type);
            // explode는 문자열을 특정 구분자를 기준으로 나누어 배열로 변환하는 함수
            $extension = $file_type_array[1];
            // 이미지 파일 타입만 가져옴
            $file_path = "img/".uniqid().".".$extension;
            // uniqid() : 이미지 이름 랜덤으로 지정

            move_uploaded_file($file["tmp_name"], MY_PATH_ROOT.$file_path);
            // $file["tmp_name"]는 임시 저장소, 임시 저장소에서 MY_PATH_ROOT.$file_path로 이동(htdocs의 img 폴더)

            $arr_prepare = [
                "title" => $_POST["title"]
                ,"rating" => $_POST["rating"]
                ,"review" => $_POST["review"]
                ,"img" => "/".$file_path
            ];
            
            my_reviews_insert($conn, $arr_prepare);

            $conn->commit();
            header("Location: /main.php");
            exit;
        } catch(Throwable $th) {
            if(!is_null($conn) && $conn->inTransaction()) {
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
    <link rel="icon" href="./img/basic/slate.png">
    <title>작성 페이지</title>
</head>
<body>
    <div class="container">
        <?php
            require_once(MY_PATH_HEADER);
        ?>
        <main>
            <form action="./insert.php" method="post" enctype="multipart/form-data">
                <div class="list">
                    <div class="insert-page_poster">
                        <input type="file" name="file" id="file" required>
                        <img id="poster_img" class="insert-page_poster_img">
                    </div>
                    <div class="content-box">
                        <input type="text" name="title" id="title" class="content-list" placeholder="제목" required>
                        <input type="number" name="rating" id="rating" class="content-list" placeholder="평점 : 0 ~ 10" min=0 max=10 required>
                        <textarea class="content-list" name="review" id="review" placeholder="감상평"></textarea>
                        <p class="content-list" style="text-align: center;"><img src="./img/basic/barcode.png" class="content-barcode"></p>
                    </div>
                </div>
                <div class="main_footer">
                    <a href="./main.php"><button class="btn-style" type="submit">완료</button></a>
                    <a href="./main.php"><button class="btn-style" type="button">취소</button></a>
                </div>
            </form>
        </main>
    </div>
</body>
<script type="text/javascript" src="show_poster_img.js"></script>
</html>