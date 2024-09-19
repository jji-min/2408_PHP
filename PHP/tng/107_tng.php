<?php

// 나의 급여를 2500만원으로 변경해주세요.
require_once("../Ex/my_db.php");

$conn = null;

try {
    $conn = my_db_conn();

    $conn->beginTransaction();

    // Update
    $sql =
        " UPDATE salaries "
        ." SET "
        ."      end_at = DATE(NOW()) "
        ."      ,updated_at = NOW() "
        ." WHERE "
        ."      emp_id = :emp_id "
        ."  AND end_at is null "
    ;
    $arr_prepare = [
        "emp_id" => 100010
    ];

    $stmt = $conn->prepare($sql); // 쿼리 준비
    $result_flg = $stmt->execute($arr_prepare); // 쿼리 실행
    $result_cnt = $stmt->rowCount(); // 영향받은 레코드 수 획득

    if(!$result_flg) {
        throw new Exception("Update Query Error");
    }
    if($result_cnt !== 1) {
        throw new Exception("Update Count Error");
    }

    // Insert
    $sql =
        " INSERT INTO salaries( "
        ."      emp_id "
        ."      ,salary "
        ."      ,start_at "
        ." ) "
        ." VALUES( "
        ."      :emp_id "
        ."      ,:salary "
        ."      ,DATE(NOW()) "
        ." ) "
    ;
    $arr_prepare = [
        "emp_id" => 100010
        ,"salary" => 25000000
    ];

    $stmt = $conn->prepare($sql); // 쿼리 준비
    $result_flg = $stmt->execute($arr_prepare); // 쿼리 실행
    $result_cnt = $stmt->rowCount(); // 영향받은 레코드 수 획득

    if(!$result_flg) {
        throw new Exception("Insert Query Error");
    }
    if($result_cnt !== 1) {
        throw new Exception("Insert Count Error");
    }

    // Commit
    $conn->commit();
} catch(Throwable $th) {
    if(!is_null($conn)) {
        $conn->rollBack();
    }
    echo $th->getMessage();
}
