<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <title>에러 페이지</title>
</head>
<body>
    <div class="container">
        <?php
            require_once(MY_PATH_HEADER);
        ?>

        <main>
            <p>에러가 발생했습니다.</p>
            <p>메인페이지로 되돌아가서 다시 실행해 주세요.</p>
            <p><?php echo $th->getMessage() ?></p>
            <a href="/main.php"><button type="button" class="btn-style" style="width: 200px;">메인 페이지로</button></a>
        </main>
    </div>
</body>
</html>