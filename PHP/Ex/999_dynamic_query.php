<?php

$data = [
    "name" => "둘리"
    ,"gender" => "M"
    ,"birth" => "1986-01-01"
];


$sql =
    " SELECT * "
    ." FROM employees "
;

$where = "";
$arr_prepare = [];

foreach($data as $key => $val) {
    if(empty($where)) {
        $where .= " WHERE ";
    } else {
        $where .= " AND ";
    }
    $where .= " ".$key." = :".$key;
    // SQL injection 방지 -> prepared statement -> place holder
    
    // prepared statement 작성
    $arr_prepare[$key] = $val;
}

$sql .= $where; // $sql = $sql.$where

// echo $sql."\n";

// print_r($arr_prepare);

require_once("../Ex/my_db.php");
$conn = my_db_conn();

$stmt = $conn->prepare($sql);
$stmt->execute($arr_prepare);

print_r($stmt->fetchAll());