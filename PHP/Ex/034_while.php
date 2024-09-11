<?php
// while문 : 조건을 체크하고 그 결과에 따라 처리를 진행하는 반복문

// 조건, 증감 주의해서 넣어야 함. 잘못하면 무한 루프
$cnt = 0;
while($cnt <= 3) {
    $cnt++;
    echo $cnt."번째 루프\n";
}
echo "-------------------------\n";

$cnt = 0;
while($cnt <= 3) {
    echo $cnt."번째 루프\n";
    $cnt++;
}
echo "-------------------------\n";

// while문으로 구구단 가능
$dan = 2;
while($dan <= 9) {
    echo "** ".$dan."단 **\n";
    $i = 1;
    while($i <= 9) {
        echo $dan." X ".$i." = ".($dan * $i)."\n";
        $i++;
    }
    $dan++;
}