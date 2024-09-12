<?php
// 1. 3의 배수 게임 (100까지)
// 출력 예) 1, 2, 짝, 4, 5, 짝, 7, 8, 짝, 10 ...

for($i = 1; $i <= 100; $i++) {
    if($i % 3 === 0) {
        echo "짝, ";
        continue;
    }
    echo $i.", ";
}
echo "\n";

echo "-------------------------\n";

for($i = 1; $i <= 100; $i++) {
    if($i % 3 === 0) {
        echo "짝, ";
        continue;
    }
    if($i === 100) {    // 100 뒤에는 ',' 나오지 않고 끝나도록
        echo $i."\n";
        break;
    }
    echo $i.", ";
}
echo "-------------------------\n";

for($i = 1; $i <= 100; $i++) {
    if(($i % 3) === 0) {    // 알아보기 쉽도록 () 추가
        echo "짝, ";
        continue;
    }
    echo $i.", ";
}
echo "\n";

echo "-------------------------\n";

// continue말고 if else문으로 작성
for($i = 1; $i <= 100; $i++) {
    if(($i % 3) === 0) {    // 알아보기 쉽도록 () 추가
        echo "짝";
    } else {
        echo $i;
    }

    if($i !== 100) {    // 마지막 100 제외하고 ',' 찍어주기
        echo ", ";
    }
}
echo "\n";

echo "-------------------------\n";

// 2. 반복문을 이용하여 급여가 5000이상이고, 성별이 남자인 사원의 id와 이름을 출력해주세요.
// 출력 예)
//      id : 1, name : 미어캣
//      id : 2, name : 홍길동
//      ...
$arr = [
    ["id" => 1, "name" => "미어캣", "gender" => "M", "salary" => "6000"]
    ,["id" => 2, "name" => "홍길동", "gender" => "M", "salary" => "3000"]
    ,["id" => 3, "name" => "갑순이", "gender" => "F", "salary" => "10000"]
    ,["id" => 4, "name" => "갑돌이", "gender" => "M", "salary" => "8000"]
];

// && 사용
foreach($arr as $key => $item) {
    if(($item["salary"] >= 5000) && ($item["gender"] === "M")) {
        echo "id : ".$item["id"].", name : ".$item["name"]."\n";
    }
}
echo "-------------------------\n";

// 중첩
foreach($arr as $key => $item) {
    if($item["salary"] >= 5000){
        if($item["gender"] === "M") {
            echo "id : ".$item["id"].", name : ".$item["name"]."\n";
        }
    }
}
echo "-------------------------\n";

foreach($arr as $key => $item) {
    if(((int)$item["salary"] >= 5000) && ($item["gender"] === "M")) {   //형변환을 통해 데이터타입을 맞췃주는 것이 더 정확함, 조건을 알아보기 쉽게 소괄호
        echo "id : ".$item["id"].", name : ".$item["name"]."\n";
    }
}

// 배열에 "birth"처럼 날짜를 입력할 때는 string으로 입력하는 것이 맞음
// 날짜를 비교하거나 계산하고 싶을 때는 형변환 필요
// 그냥 2020-01-01로 입력 하고 비교했을 때 가능한 것은 PHP가 자동으로 숫자를 계산함