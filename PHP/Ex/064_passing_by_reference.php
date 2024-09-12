<?php
// 값복사(Value Of Copy)
$num1 = 100;    // 고유한 주소값에 저장됨
$num2 = $num1;  // copy of value 값 복사

$num2 -= 50;

echo $num1, $num2;  // num1 = 100, num2 = 50

// 참조형(Passing By Reference)
$num3 = 100;    // 고유한 주소값에 저장됨
$num4 = &$num3;  // num4가 num3을 참조

$num4 -= 50;

echo $num3, $num4;  // num3 = 50, num4 = 50

// array_splice(); // 기본적으로 참조 사용

// int, float, double, string, boolean, null, array -> 값 복사
// object -> 참조 전달

echo "\n";

// 4 출력
function my_test(&$num) {
    $num--;
    echo "my_test() : ".$num."\n";
}

$num5 = 5;
my_test($num5);
echo $num5;

echo "\n";

// 5 출력
// function my_test($num) {
//     $num--;
//     echo "my_test() : ".$num."\n";  // 함수 내에서만 계산됨, 함수 끝나면 사라짐
// }

// $num5 = 5;
// my_test($num5);
// echo $num5;

echo "\n";


// ---------------------------
// 스코프 : 변수나 함수의 유효 범위
// ---------------------------

// 전역 스코프
$str = "전역 스코프";

// 함수는 지역 스코프, 전역 스코프에 포함 안됨, 전역 스코프에 접근하려면 따로 작업해줘야 함
function my_scope1() {
    global $str;    // 전역스코프 사용을 위해 선언
    echo $str;
}

my_scope1();

echo "\n";

// 지역 스코프 -> 함수, 클래스, 메소드는 무조껀 지역
function my_scope2() {
    $str2 = "my_scope2 영역"; // 이 함수가 끝나면 지역 스코프는 없어짐
    echo $str2;
}
// echo $str2; // 지역 내에서만 접근 가능
my_scope2();

for($i = 1; $i < 6; $i++) {
    $str3 = "포문";
}
echo $str3; // for문은 지역에 포함 안됨