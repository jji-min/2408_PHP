<?php
// foreach 문 : 배열을 편하게 루프하기 위한 반복문
$arr = [1, 2, 3];
foreach($arr as $key => $val) {
    echo "key : ".$key.", value : ".$val."\n";
}
echo "----------------------\n";

// for를 사용해서 배열을 반복하는 경우
$maxIndex = count($arr) - 1; // 개수는 3이지만 $arr[3]은 없으니까 맞춰줌
for($i = 0; $i <= $maxIndex; $i++) {
    echo "key : ".$i.", value : ".$arr[$i]."\n";
}
echo "----------------------\n";

// 아래 arr2를 이용해서 구구단 2단을 찍어주세요.
$arr2 = [1, 2, 3, 4, 5, 6, 7, 8, 9];
$dan = 2;
foreach($arr2 as $key => $val) {
    echo $dan." X ".$val." = ".($dan * $val)."\n";
}
echo "----------------------\n";

foreach($arr2 as $key => $val) {
    echo "2 X ".$val." = ".($val * 2)."\n";
}
echo "----------------------\n";

// key가 필요없으면 생략 가능
// 값만 계속 담김. key는 없음
foreach($arr2 as $val) {
    echo "2 X ".$val." = ".($val * 2)."\n";
}
echo "----------------------\n";

// 연관배열의 경우(key를 우리가 설정)
$arr3 = [
    "name" => "superstar"
    ,"age" => 20
    ,"gender" => "M"
];

foreach($arr3 as $key => $val) {
    echo $key." : ".$val."\n";
}
echo "----------------------\n";


// 이차원배열의 경우
$result = [
    ["id" => 1, "name" => "미어캣", "gender" => "M"]
    ,["id" => 2, "name" => "강아지", "gender" => "M"]
    ,["id" => 3, "name" => "고양이", "gender" => "F"]
];

foreach($result as $key => $item) {
    echo $item["name"]."\n";    // name만 출력
}

foreach($result as $key => $item) {
    var_dump($item);    // 다 출력
}

foreach($result as $key => $item) {
    if($item["name"] === "고양이") {    // if문으로 조건 줄 수 있음
        echo $item["name"]."\n";
    }
}