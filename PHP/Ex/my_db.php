<?php
function my_db_conn() {
    // DB 접속 정보
    $my_host = "localhost"; // DB Host
    $my_user = "root";  // DB 계정명
    $my_password = "php504"; // DB 계정 비밀번호
    $my_db_name = "dbsample";  // 접속할 DB명
    $my_charset = "utf8mb4";  // DB Charset
    $my_dsn = "mysql:host=".$my_host.";dbname=".$my_db_name.";charset=".$my_charset;  // DSN, Data Source Name, DB 접속하기 위한 문자열

    // PDO 옵션 설정
    $my_otp = [
        // Prepared Statement로 쿼리를 준비할 때, PHP와 DB 어디에서 에뮬레이션 할지 여부를 결정
        PDO::ATTR_EMULATE_PREPARES      => false  // DB에서 에뮬레이션 하도록 설정
        // PDO에서 예외를 처리하는 방식을 지정
        ,PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
        // DB의 결과를 fetch(DB에서 가져온 정보는 다루기 쉽도록 변경)하는 방식을 지정
        ,PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC  // 연관배열로 fetch
    ];

    // DB 접속
    return new PDO($my_dsn, $my_user, $my_password, $my_otp);
}