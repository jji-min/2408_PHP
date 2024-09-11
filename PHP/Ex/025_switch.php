<?php

$food = "짬뽕";

if($food === "떡볶이") {
    echo "한식";
} else if($food === "짜장면") {
    echo "중식";
} else if($food === "햄버거") {
    echo "양식";
}

echo "\n";

// switch 문
switch($food) {
    case "떡볶이":
        echo "한식";
        break;      // break 생략시 다음 처리도 계속 이어감.
    case "짜장면":
        echo "중식";
        break;
    case "햄버거":
        echo "양식";
        break;
    default:
        echo "맛있음";
        break;
}

echo "\n";

switch($food) {
    case "떡볶이":
        echo "한식";
        break;
    case "짬뽕":    // 짬뽕도 중식으로 출력됨.
    case "짜장면":
        echo "중식";
        break;
    case "햄버거":
        echo "양식";
        break;
    default:
        echo "맛있음";
        break;
}

echo "\n";

// switch를 이용하여 작성
// 1등이면 금상, 2등이면 은상, 3등이면 동상, 4등이면 장려상, 그 외는 노력상
// 을 출력해 주세요.
$rank = "1등";
switch($rank) {
    case "1등":
        echo "금상";
        break;
    case "2등":
        echo "은상";
        break;
    case "3등":
        echo "동상";
        break;
    case "4등":
        echo "장려상";
        break;
    default:
        echo "노력상";
        break;
}

echo "\n";

$rank = 1;
switch($rank) {
    case 1:
        echo "금상";
        break;
    case 2:
        echo "은상";
        break;
    case 3:
        echo "동상";
        break;
    case 4:
        echo "장려상";
        break;
    default:
        echo "노력상";
        break;
}

echo "\n";

// 숫자만 적거나 문자열로 적어도 출력 가능하게.
$rank = "1등";
switch($rank) {
    case 1:
    case "1등":
        echo "금상";
        break;
    case 2:
    case "2등":
        echo "은상";
        break;
    case 3:
    case "3등":
        echo "동상";
        break;
    case 4:
    case "4등":
        echo "장려상";
        break;
    default:
        echo "노력상";
        break;
}