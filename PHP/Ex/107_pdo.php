<?php

// ------------------
// PDO Class : DB 엑세스 방법 중 하나

// // DB 접속 정보
// $my_host = "localhost"; // DB Host
// $my_user = "root";  // DB 계정명
// $my_password = "php504"; // DB 계정 비밀번호
// $my_db_name = "dbsample";  // 접속할 DB명
// $my_charset = "utf8mb4";  // DB Charset
// $my_dsn = "mysql:host=".$my_host.";dbname=".$my_db_name.";charset=".$my_charset;  // DSN, Data Source Name, DB 접속하기 위한 문자열

// // PDO 옵션 설정
// $my_otp = [
//     // Prepared Statement로 쿼리를 준비할 때, PHP와 DB 어디에서 에뮬레이션 할지 여부를 결정
//     PDO::ATTR_EMULATE_PREPARES      => false  // DB에서 에뮬레이션 하도록 설정
//     // PDO에서 예외를 처리하는 방식을 지정
//     ,PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
//     // DB의 결과를 fetch(DB에서 가져온 정보는 다루기 쉽도록 변경)하는 방식을 지정
//     ,PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC  // 연관배열로 fetch
// ];
// // 위에는 다 똑같이 작성함

// // DB 접속
// $conn = new PDO($my_dsn, $my_user, $my_password, $my_otp);

// // select
// $sql = "SELECT
//             *
//         FROM employees
//         ORDER BY emp_id ASC
//         LIMIT 5";

// $stmt = $conn->query($sql); // PDO::query() : 쿼리 준비 + 실행 / PDO Statement인 class가 담겨있음, 인스턴스화
// $result = $stmt->fetchAll(); // 질의 결과를 패치
// print_r($result);   // 연관배열로 출력

// // 사번과 이름만 출력
// foreach($result as $item) {
//     echo $item["emp_id"]." ".$item["name"]."\n";
// }


// --------------------
// 복습

// DB 정보
$my_host = "localhost"; // host
$my_port = "3306"; // port
$my_user = "root"; // user
$my_password = "php504"; // password
$my_db_name = "dbsample"; // DB name
$my_charset = "utf8mb4"; // charset 컴퓨터가 글자를 어떻게 인식할 것인지 설정
// 수정이 발생하면 이전 소스코드는 지우지 않고 comment out으로 이전 코드를 남겨둠

// DSN
$my_dsn = "mysql:host=".$my_host.";port=".$my_port.";dbname=".$my_db_name.";charset=".$my_charset;

// PDO option
$my_option = [
    // Prepared Statement의 애뮬레이션 설정
    PDO::ATTR_EMULATE_PREPARES      => false
    // 예외 발생시, 예외 처리 방법 설정
    ,PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
    // Fetch할 때 데이터 타입 설정 - 연관배열(퓨어 PHP), 클래스(객체 지향적 프로그램)
    ,PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC
];

// PDO Class 인스턴스
$conn = new PDO($my_dsn, $my_user, $my_password, $my_option);

// // select
// // 한줄로 적어도 상관없음. 아래와 같이 적을 때(유지보수 용이)는 문자열 앞뒤에 공백을 넣을 것.
// $sql = " SELECT "
//         ."      * "
//         ." FROM "
//         ."      employees "
//         ." LIMIT 3 "
//         ;

// $stmt = $conn->query($sql); // 쿼리 실행
// $result = $stmt->fetchAll(); // 결과 Fetch

// print_r($result);


// select 예제
$sql = " SELECT "
        ." * "
        ." FROM "
        ."      employees "
        ." WHERE "
        ."      emp_id = :emp_id1 "
        ."   OR emp_id = :emp_id2 "
;
$prepare = [
    "emp_id1" => 10001
    ,"emp_id2" => 10002
];
// execute는 보내줘야하는 파라미터 데이터타입이 배열

$stmt = $conn->prepare($sql); // 쿼리 준비
$stmt->execute($prepare); // 쿼리 실행
$result = $stmt->fetchAll(); // 결과 Fetch

print_r($result);