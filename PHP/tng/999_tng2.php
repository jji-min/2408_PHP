<?php
// 가위 바위 보 게임
// 게임 실행시, "가위", "바위", "보" 중 하나를 입력
// 컴퓨터는 랜덤으로 "가위", "바위", "보" 중 하나를 출력
// 결과를 출력
//      유저 : 가위
//      컴퓨터 : 바위
//      졌습니다. or 이겼습니다.

// 값을 입력받음
// fscanf(STDIN, "%d\n", $input);
fscanf(STDIN, "%s\n", $input);

echo "유저 : ".$input."\n";
// trim으로 좌우 공백을 잘라주는것도 좋음

$game = ["rock", "paper", "scissors"];
// $com_num = random_int(0, 2); // 따로 변수 지정하지 않아도 가능
$computer = $game[random_int(0, 2)];

echo "컴퓨터 : ".$computer."\n";

if($input === "rock") {
    switch($computer) {
        case "paper":
            echo "졌습니다.\n";
            break;
        case "scissors":
            echo "이겼습니다.\n";
            break;
        case "rock":
            echo "비겼습니다.\n";
            break;
    }
} else if($input === "paper") {
    switch($computer) {
        case "scissors":
            echo "졌습니다.\n";
            break;
        case "rock":
            echo "이겼습니다.\n";
            break;
        default:
            echo "비겼습니다.\n";
            break;
    }
} else if($input === "scissors"){
    switch($computer) {
        case "rock":
            echo "졌습니다.\n";
            break;
        case "paper":
            echo "이겼습니다.\n";
            break;
        default:
            echo "비겼습니다.\n";
            break;
    }
}

// if문만 사용 - &&, ||
if($input === $computer) {
    echo "비겼습니다.\n";
} else if((($input === "rock") && ($computer === "scissors")) || (($input === "paper") && ($computer === "rock")) || (($input === "scissors") && ($computer === "paper"))) {
    echo "이겼습니다.\n";
} else {
    echo "졌습니다.\n";
}

// if문만 사용 - and, or
if($input === $computer) {
    echo "비겼습니다.\n";
} else if((($input === "rock") and ($computer === "scissors")) or (($input === "paper") and ($computer === "rock")) or (($input === "scissors") and ($computer === "paper"))) {
    echo "이겼습니다.\n";
} else {
    echo "졌습니다.\n";
}

// // 배열의 key값으로 하려니 더 복잡해짐...별로네
// $user_num = 0;
// foreach($game as $key => $val) {
//     if($val === $input) { 
//         $user_num = $key;
//     }
// }

// if($user_num === $com_num) {
//     echo "비겼습니다.\n";
// } else if($user_num === 2) {
//     $user_num -= 3;
//     if($user_num > $com_num) {
//         echo "이겼습니다.\n";
//     } else if($user_num < $com_num) {
//         echo "졌습니다.\n";
//     }
// } else {
//     if($user_num > $com_num) {
//         echo "이겼습니다.\n";
//     } else if($user_num < $com_num) {
//         echo "졌습니다.\n";
//     }
// }

// 상수를 활용하는 방법도 있음 -> 미리 배열, 메세지등을 설정 -> 수정이 생기면 해당 상수만 변경해주면됨