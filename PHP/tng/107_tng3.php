<?php
require_once("../Ex/my_db.php");

// 3명의 신규 사원 정보를 employees에 추가해야한다.
// 성공한건 삽입되고, 실패한 것만 안들어감

$data = [
    ["name" => "둘리", "birth" => "1986-01-01", "gender" => "M"]
    ,["name" => "희동이", "birth" => "ㅇㅇㅇ", "gender" => "M"]
    ,["name" => "고길동", "birth" => "1968-01-01", "gender" => "M"]
];

$conn = null;

try {
    $conn = my_db_conn();

    foreach($data as $item) {
        try {
            // transaction Start
            $conn->beginTransaction();

            // -------------------------
            // 새로운 사원 정보 삽입
            $sql =
                " INSERT INTO employees( "
                ."      name "
                ."      ,birth "
                ."      ,gender "
                ."      ,hire_at"
                ." ) "
                ." VALUES( "
                ."      :name "
                ."      ,:birth "
                ."      ,:gender "
                ."      ,DATE(NOW()) "
                ." ) "
            ;
            $arr_prepare = [
                "name" => $item["name"]
                ,"birth" => $item["birth"]
                ,"gender" => $item["gender"]
            ];

            $stmt = $conn->prepare($sql);
            $result_flg = $stmt->execute($arr_prepare);
            // foreach문 안에서 똑같은 동작을 3번 반복 -> 비효율 -> 바꾸는건 난이도가 있음

            if(!$result_flg) {
                throw new Exception("Insert exec Error : employees");
            }
            if($stmt->rowCount() !== 1) {
                throw new Exception("Insert Row Count Error : employees");
            }

            // commit
            $conn->commit();
        } catch(Throwable $th) {
            if(!is_null($conn)) {
                // 안정상 한번 더 체크
                $conn->rollBack();
            }
            echo "안쪽 try문 : ".$th->getMessage();
        }
    }

} catch(Throwable $th) {
    echo "바깥쪽 try문 : ".$th->getMessage();
}