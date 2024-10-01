<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
    require_once(MY_PATH_DB_LIB);
    require_once(MY_PATH_PRINT_STARS);

    $conn = null;
    try {
        $conn = my_db_conn();
        $max_reviews_cnt = my_reviews_total_count($conn);  // 게시글 총 수
        $max_page = (int)ceil($max_reviews_cnt / MY_LIST_COUNT);  // max_page

        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
        $offset = ($page - 1) * MY_LIST_COUNT;

        $prev_page_number = $page - 1 < 1 ? 1 : $page - 1;  // 이전 페이지
        $next_page_number = $page + 1 > $max_page ? $max_page : $page + 1;  // 다음 페이지

        $start_page_button_number = (int)(floor(($page - 1) / MY_PAGE_BUTTON_COUNT) * MY_PAGE_BUTTON_COUNT) + 1;  // 화면 표시 페이지 버튼 시작 값
        $end_page_button_number = $start_page_button_number + (MY_PAGE_BUTTON_COUNT - 1);  // 화면 표시 페이지 버튼 마지막 값
        $end_page_button_number = $end_page_button_number > $max_page ? $max_page : $end_page_button_number;  // max page 초과시 페이지 버튼 마지막 값 조절

        $arr_prepare = [
            "list_cnt" => MY_LIST_COUNT
            ,"offset" => $offset
        ];

        $result = my_reviews_select_pagination($conn, $arr_prepare);
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
                <?php foreach($result as $item) { ?>
                    <div class="main-page_poster">
                        <img src="<?php echo $item["img"] ?>" class="box-size">
                        <div class="img_display">
                            <div class="box-size box_hover_content" onclick="location.href='./detail.php?id=<?php echo $item['id'] ?>'">
                                <h2><?php echo $item["title"] ?></h2>
                                <p class="star-group">
                                    <?php echo print_stars($item) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="main_footer">
                <?php if($page !== 1) { ?>
                    <a href="./main.php?page=<?php echo $prev_page_number ?>"><button class="btn-style"><</button></a>
                <?php } ?>
                <?php for($i = $start_page_button_number; $i <= $end_page_button_number; $i++) { ?>
                    <a href="./main.php?page=<?php echo $i ?>"><button class="btn-style <?php echo $page === $i ? "btn-selected" : "" ?>"><?php echo $i ?></button></a>
                <?php } ?>
                <?php if($page !== $max_page) { ?>
                    <a href="./main.php?page=<?php echo $next_page_number ?>"><button class="btn-style">></button></a>
                <?php } ?>
            </div>
        </main>
    </div>
</body>
</html>