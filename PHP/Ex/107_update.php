<?php

require_once("./my_db.php");

$conn = null; // my_db_conn()에서 오류 발생시 변수 선언이 되지 않고 catch로 바로 넘어가서 변수가 없다고 인식하기 때문에 초기값을 줘야함

try {
    // PDO Class 인스턴스화
    $conn = my_db_conn();

    $sql = 
        " UPDATE employees "
        ." SET "
        ."      name = :name "
        ."      ,updated_at = NOW() "
        ." WHERE "
        ."      emp_id = :emp_id "
    ;
    $arr_prepare = [
        "name" => "갑순이"
        ,"emp_id" => 100001
    ];

    $conn->beginTransaction(); // 트랜잭션 시작

    $stmt = $conn->prepare($sql); // 쿼리 준비
    // 결과가 PDOStatement로 반환됨
    $result_flg = $stmt->execute($arr_prepare); // 쿼리 실행
    $result_cnt = $stmt->rowCount(); // 영향받은 레코드 수 반환

    if(!$result_flg) {
        throw new Exception("쿼리 실행 예외 발생");
    }

    if($result_cnt !== 1) {
        throw new Exception("수정 레코드수 이상");
    }

    $conn->commit(); // 커밋 처리
} catch(Throwable $th) {
    if(!is_null($conn)) {
        $conn->rollBack();
    }
    echo $th->getMessage();
}

// 예를 들어, 연봉을 수정하기 위해, 과거 연봉 이력을 수정하고 새로운 데이터를 추가할 때, 제일 먼저 트랜잭션부터 시작해야함
// -> update는 성공했지만 insert에서 실패하면 update했던것도 다시 rollback해야하기 때문