<?php

// ---------------------------
// if문 : 조건에 따라서 서로 다른 처리를 할 때 사용하는 문법
// ---------------------------
$num = 100;
if($num === 10) {
    echo "10입니다!\n";
} else if($num === 5) {
    echo "5입니다!\n";
} else if($num === 7){
    echo "럭키\n";
} else {
    echo "숫자입니다.\n";
}


// 1이면 1등, 2면 2등, 3이면 3등, 나머지는 순위 외, 5번만 특별상을 출력
$rank = 5;
if($rank === 1){
    echo "1등";
} else if($rank === 2){
    echo "2등";
} else if($rank === 3){
    echo "3등";
} else if($rank === 5){
    echo "특별상";
} else {
    echo "순위 외";
}

echo "\n";

$rank = 4;
if($rank === 1){
    echo "1등";
} else if($rank === 2){
    echo "2등";
} else if($rank === 3){
    echo "3등";
} else if($rank === 4 || $rank === 5){
    echo "특별상";
} else {
    echo "순위 외";
}

echo "\n";

// 데이터타입 확인
$rank = "5";
if(gettype($rank) === "integer"){

    if($rank === 1){
        echo "1등";
    } else if($rank === 2){
        echo "2등";
    } else if($rank === 3){
        echo "3등";
    } else if($rank === 5){
        echo "특별상";
    } else {
        echo "순위 외";
    }
} else {
    echo "숫자가 아닙니다.";
}

echo "\n";

// 1번 문제의 정답은 2, 2번 문제의 정답은 5
// 1번 문제와 2번 문제 모두 정답이면 100점,
// 둘 중 하나만 정답이면 50점,
// 모두 오답이면 0점을 출력
$answer1 = 2;
$answer2 = 1;

if($answer1 === 2 && $answer2 === 5) {
    echo "100점";
} else if ($answer1 === 2 || $answer2 === 5){
    echo "50점";
} else {
    echo "0점";
}