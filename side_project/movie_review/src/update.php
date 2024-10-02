<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
    require_once(MY_PATH_DB_LIB);

    $conn = null;

    try {
        if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET") {
            // GET 처리

            $id = isset($_GET["id"]) ? $_GET["id"] : 0;

            $page = isset($_GET["page"]) ? $_GET["page"] : 1;

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

            $page = isset($_POST["page"]) ? (int)$_POST["page"] : 1;  // page 획득

            $title = isset($_POST["title"]) ? $_POST["title"] : "";  // title 획득

            $rating = isset($_POST["rating"]) ? $_POST["rating"] : 0;  // rating 획득

            if($id < 1 || $title === "") {
                throw new Exception("파라미터 오류");
            }

            $conn = my_db_conn();

            $file = $_FILES["file"];

            $conn->beginTransaction();

            if($file["name"] === "") {
                $arr_prepare = [
                    "id" => $id
                    ,"title" => $title
                    ,"rating" => $rating
                    ,"review" => $_POST["review"]
                ];
                
                my_reviews_noimg_update_id($conn, $arr_prepare);
            } else {
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
                    "id" => $id
                    ,"title" => $title
                    ,"rating" => $rating
                    ,"review" => $_POST["review"]
                    ,"img" => "/".$file_path
                ];
                
                my_reviews_update_id($conn, $arr_prepare);
            }

            $conn->commit();
            header("Location: /detail.php?id=".$id."&page=".$page);
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
    <link rel="stylesheet" href="./css/update.css">
    <link rel="icon" href="./img/basic/slate.png">
    <script src="https://kit.fontawesome.com/f82e475176.js" crossorigin="anonymous"></script>
    <title>수정 페이지</title>
</head>
<body>
    <div class="container">
        <?php
            require_once(MY_PATH_HEADER);
        ?>
        <main>
            <form action="./update.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?php echo $result["id"] ?>">
                <input type="hidden" name="page" id="page" value="<?php echo $page ?>">
                <div class="list">
                    <div class="update-page_poster">
                        <input type="file" name="file" id="file">
                        <img id=poster_img src="<?php echo $result["img"] ?>" class="update-page_poster_img">
                    </div>
                    <div class="content-box">
                        <input type="text" name="title" id="title" class="content-list" value="<?php echo $result["title"] ?>" required>
                        <input type="number" name="rating" id="rating" class="content-list" value="<?php echo $result["rating"] ?>" min=0 max=10 required>
                        <textarea class="content-list" name="review" id="review"><?php echo $result["review"] ?></textarea>
                        <p class="content-list" style="text-align: center;"><img src="./img/basic/barcode.png" class="content-barcode"></p>
                    </div>
                </div>
                <div class="main_footer">
                    <button class="btn-style" type="submit">완료</button>
                    <a href="./detail.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button class="btn-style" type="button">취소</button></a>
                </div>
            </form>
        </main>
    </div>
</body>
<script type="text/javascript" src="show_poster_img.js"></script>
</html>