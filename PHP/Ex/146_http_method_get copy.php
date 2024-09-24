<?php

    // HTTP Method GET 요청 데이터를 받는 방법
    // echo isset($_GET["id"]) ? $_GET["id"] : 1;
    // 삼항 연산자 - echo 조건식 ? 참일 경우 : 거짓일 경우;
    // isset() - 해당 변수가 있는지 확인함

    var_dump($_GET);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="get">
        <input type="text" name="id" id="id">
        <br>
        <button type="submit">버튼</button>
    </form>
    <!-- get으로 보내면 url에 입력한 값이 출력됨, name으로 설정한 것이 key가 되고 내용은 값이 됨 -->
</body>
</html>