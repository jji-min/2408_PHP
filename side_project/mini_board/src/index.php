<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

try {
    // PDO Instance
    $conn = my_db_conn();

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

    // ----------------------------------
    // pagination select 처리
    // ----------------------------------
    $arr_prepare = [
        "list_cnt" => MY_LIST_COUNT
        ,"offset"  => $offset
    ];

    $result = my_board_select_pagination($conn, $arr_prepare);
} catch(Throwable $th) {
    echo $th->getMessage();
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
    <header>
        <h1>Mini Board</h1>
    </header>
    <main>
        <div class="main-top">
            <!-- 자식을 우측 정렬 -->
            <a href="./insert.html">
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
                <div><a href="./detail.html"><?php echo $item["title"] ?></a></div>
                <div><?php echo $item["created_at"] ?></div>
            </div>
            <?php } ?>
        </div>
        <div class="main-footer">
            <a href="/index.php?page=1"><button class="btn-small">이전</button></a>
            <a href="/index.php?page=1"><button class="btn-small">1</button></a>
            <a href="/index.php?page=2"><button class="btn-small">2</button></a>
            <a href="/index.php?page=3"><button class="btn-small">3</button></a>
            <a href="/index.php?page=4"><button class="btn-small">4</button></a>
            <a href="/index.php?page=5"><button class="btn-small">5</button></a>
            <a href="/index.php?page=6"><button class="btn-small">다음</button></a>
        </div>
    </main>
</body>
</html>