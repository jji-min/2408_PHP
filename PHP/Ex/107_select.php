<?php

require_once("./my_db.php");

try {
    $conn = my_db_conn();
    5 / 0;
    $id = 1;
    // Prepared Statement
    // sql injection 막음
    $sql = " SELECT "
            ."    * "
            ." FROM employees "
            ." WHERE "
            ."   emp_id = :emp_id " // placeholder 관습적으로 DB의 컬럼명과 동일
            ."   AND name = :name "
    ;   // 연결연산자로 연결하는 것이 유지보수가 용이함, 반드시 문자열 양끝에 공백 넣기(안 넣으면 쭉 이어지게 인식해서 오류)
    $arr_prepare = [
        "emp_id" => $id
        ,"name" => "홍길동"
    ];

    $stmt = $conn->prepare($sql);   // DB 질의 준비
    $stmt->execute($arr_prepare);   // 질의실행
    $result = $stmt->fetchAll();    // 질의 결과 패치
} catch(Throwable $th) {    // 예외와 에러의 최상위 interface, 발생한 에러의 정보를 가지고 있음
    echo $th->getMessage(); // 예외 메세지 출력
}