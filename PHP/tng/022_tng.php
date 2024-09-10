<?php
// IF로 만들어주세요.
// 성적
// 범위 :
//      100   : A+
//      90이상 100미만 : A
//      80이상 90미만 : B
//      70이상 80미만 : C
//      60이상 70미만 : D
//      60미만: F

// 출력 문구 : "당신의 점수는 XXX점 입니다. <등급>"

$score = 100;
$grade = "";    //$grade = 0; -> 데이터 타입과 맞지 않음
// 데이터 타입을 맞춰서 초기값을 지정하는 것이 좋음

if($score === 100) {
    $grade = "A+";
} else if($score >= 90 && $score < 100) {
    $grade = "A";
} else if($score >= 80 && $score < 90) {
    $grade = "B";
} else if($score >= 70 && $score < 80) {
    $grade = "C";
} else if($score >= 60 && $score < 70) {
    $grade = "D";
} else if($score < 60){
    $grade = "F";
}

echo "당신의 점수는 ".$score."점 입니다. <".$grade.">";
echo "\n";

// ---------------------------------------------------------------------------------

$score = 100;
$grade = "";

if($score === 100) {
    $grade = "A+";
} else if($score >= 90) {
    $grade = "A";
} else if($score >= 80) {
    $grade = "B";
} else if($score >= 70) {
    $grade = "C";
} else if($score >= 60) {
    $grade = "D";
} else {
    $grade = "F";
}

// 조건을 2개씩 점검하는 것은 비효율적
// 불필요한 조건은 작성하지 않는 것이 효율적 

echo "당신의 점수는 ".$score."점 입니다. <".$grade.">";
echo "\n";

// ---------------------------------------------------------------------------------

$score = 50;
$grade = "";

if($score >= 0 && $score <= 100) {
    if($score === 100) {
        $grade = "A+";
    } else if($score >= 90) {
        $grade = "A";
    } else if($score >= 80) {
        $grade = "B";
    } else if($score >= 70) {
        $grade = "C";
    } else if($score >= 60) {
        $grade = "D";
    } else {
        $grade = "F";
    }
    echo "당신의 점수는 ".$score."점 입니다. <".$grade.">";
}