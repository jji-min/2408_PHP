<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;
$max_board_cnt = 0;
$max_page = 0;

try {
    // PDO Instance
    $conn = my_db_conn();

    // ----------------------------------
    // max page 획득 처리
    // ----------------------------------
    $max_board_cnt = my_board_total_count($conn);  // 게시글 총 수 획득
    $max_page = (int)ceil($max_board_cnt / MY_LIST_COUNT);  // max page 획득
    // 게시글 총 수에서 한페이지에 보여줄 만큼의 수를 나누고 올림 -> 다보여주려면 올림해야함
    // ceil하면 float타입이 됨 -> int로 형변환 필요

    // ----------------------------------
    // pagination 설정 처리
    // ----------------------------------
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    // user가 get method방식으로 값을 보내면 $_GET에 다 들어있음
    // get으로 받아온 값의 데이터 타입이 string으로 되어있어 형변환해주는 것이 좋음
    // post도 user한테 받아온 값의 데이터 타입이 string임
    // isset() : 변수가 설정되어 있는지 확인
    // 제일 첨을 들어가면 page가 1이 되도록 지정
    $offset = ($page - 1) * MY_LIST_COUNT;
    $start_page_button_number = (int)(floor(($page - 1) / MY_PAGE_BUTTON_COUNT) * MY_PAGE_BUTTON_COUNT) + 1;  // 화면 표시 페이지 버튼 시작 값
    $end_page_button_number = $start_page_button_number + (MY_PAGE_BUTTON_COUNT - 1);  // 화면 표시 페이지 버튼 마지막 값
    $end_page_button_number = $end_page_button_number > $max_page ? $max_page : $end_page_button_number;  // max page 초과시 페이지 버튼 마지막 값 조절
    $prev_page_button_number = $page - 1 < 1 ? 1 : $page - 1;  // 이전 버튼
    $next_page_button_number = $page + 1 > $max_page ? $max_page : $page + 1; // 다음 버튼 

    // ----------------------------------
    // pagination select 처리
    // ----------------------------------
    $arr_prepare = [
        "list_cnt" => MY_LIST_COUNT
        ,"offset"  => $offset
    ];

    $result = my_board_select_pagination($conn, $arr_prepare);
} catch(Throwable $th) {
    // catch에 $th를 적지않으면 $th를 찾지 못해 에러 발생함
    // echo $th->getMessage();
    require_once(MY_PATH_ERROR);
    exit; // 이후의 처리를 하지 않음
}

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>리스트 페이지</title>
</head>
<body>
    <?php 
        require_once(MY_PATH_ROOT."header.php");
    ?>

    <main>
        <div class="main-top">
            <!-- 자식을 우측 정렬 -->
            <a href="/insert.php">
                <button class="btn-middle">글 작성</button>
            </a>
        </div>
        <div class="main-list">
            <div class="item list-head">
                <div>게시글 번호</div>
                <div>게시글 제목</div>
                <div>작성일자</div>
            </div>
            <?php foreach($result as $item) { ?>
            <div class="item list-content">
                <div><?php echo $item["id"] ?></div>
                <div><a href="/detail.php?id=<?php echo $item["id"] ?>&page=<?php echo $page ?>"><?php echo $item["title"] ?></a></div>
                <div><?php echo $item["created_at"] ?></div>
            </div>
            <?php } ?>
        </div>
        <div class="main-footer">
            <?php if($page !== 1) { ?>
                <a href="/index.php?page=<?php echo $prev_page_button_number ?>"><button class="btn-small">이전</button></a>
            <?php } ?>
            <?php for($i = $start_page_button_number; $i <= $end_page_button_number; $i++) { ?>
                <a href="/index.php?page=<?php echo $i ?>"><button class="btn-small <?php echo $page === $i ? "btn-selected" : "" ?>"><?php echo $i ?></button></a>
            <?php } ?>
            <?php if($page !== $max_page) { ?>
                <a href="/index.php?page=<?php echo $next_page_button_number ?>"><button class="btn-small">다음</button></a>
            <?php } ?>
        </div>
    </main>
</body>
</html>