<?php
require_once("./my_db.php");

$conn = null; // object인 pdo class가 담기기 때문에 초기값은 null
try {
    $conn = my_db_conn();

    // sql
    $sql =
        " INSERT INTO employees( "
        ."      name "
        ."      ,birth "
        ."      ,gender "
        ."      ,hire_at "
        ." ) "
        . " VALUES( "
        ."      :name "
        ."      ,:birth "
        ."      ,:gender "
        ."      ,DATE(NOW()) "
        ." ) "
    ;
    $arr_prepare = [
        "name"      => "홍길동"
        ,"birth"    => "2000-01-01"
        ,"gender"   => "M"
    ];
    // php는 대소문자 구분, 공백 주의

    // transaction 시작
    $conn->beginTransaction(); // commit 하지 않으면 rollback됨

    $stmt = $conn->prepare($sql); // 쿼리 준비
    $exec_flg = $stmt->execute($arr_prepare); // 쿼리 실행
    $result_cnt = $stmt->rowCount(); // 영향 받은 레코드 수를 반환

    // 쿼리 실행 예외 처리
    // 에러 발생하면 실행이 멈추기 때문에 user들에게 에러 페이지 이동 등 에러 처리를 해주어야하기 때문에 실행
    if(!$exec_flg) {
        throw new Exception("execute 예외 발생", "1"); // 강제로 예외 발생
        // 에러코드 세팅 가능, catch로 던짐, 이 처리가 발생하면 catch로 이동
    }
    // execute에서 false가 넘어올 확률은 낮음, DB에서 발생한 에러는 바로 예외처리됨, 실행 결과를 처리하는 과정에서 false발생시 실행됨

    // 영향 받은 레코드수 이상
    if($result_cnt !== 1) {
        throw new Exception("레코드수 이상", "2"); // 강제로 예외 발생
    }

    // commit 처리
    $conn->commit();
} catch(Throwable $th) { // $th : 코드들을 담고 있음
    // $conn->rollBack(); // 결국 에러가 발생하면 catch로 오기때문에 catch에서 실행함
    // pdo를 불러오는 파일에서 에러가 발생하면 return값이 없어서 $conn은 pdo를 가지고 있지 않아서 에러 발생

    // PDO 인스턴스화 됐는지 확인
    if(!is_null($conn)) {
        $conn->rollBack();
    }
    echo $th->getCode()." ".$th->getMessage(); // 에러 발생한 코드 & 에러 메시지 출력
}