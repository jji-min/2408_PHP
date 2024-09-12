<?php

// 두 수를 전달해주면 합을 반환해주는 함수
// 함수 정의

/**
 * 두 수를 더해서 반환
 */
function my_sum($num1, $num2) {
    return $num1 + $num2;   // return 생략 가능하지만 보통 넣음
}

my_sum(3, 5);   // 함수 호출

time();


// 두 수를 받아서 -, *, /, %의 결과를 리턴하는 함수를 만들어 주세요.
/**
 * 두 수를 빼서 반환
 */
function my_sub($num1, $num2) {
    return $num1 - $num2;
}
echo my_sub(5, 3)."\n";
/**
 * 두 수를 곱해서 반환
 */
function my_multi($num1, $num2) {
    return $num1 * $num2;
}
echo my_multi(5, 3)."\n";
/**
 * 두 수를 나눠서 반환
 */
function my_div($num1, $num2) {
    return $num1 / $num2;
}
echo my_div(5, 3)."\n";
/**
 * 두 수를 나눴을 때 나머지 반환
 */
function my_remain($num1, $num2) {
    return $num1 % $num2;
}
echo my_remain(5, 3)."\n";

// -------------------
// 가변 길이 아규먼트

// 전달되는 모든 숫자를 더해서 반환
// ... 을 이용하는 방법 (** 주의 : php5.6 이상에서 사용가능)
function my_sum_all(...$numbers) {  // ...$numbers -> 몇 개를 보내든 다 받음, 데이터 타입이 Array
    // $sum = 0;

    // foreach($numbers as $val) {
    //     $sum += $val;
    // }

    // return $sum;

    return array_sum($numbers);
}

// 5.5버전 이하일때 가변 길이 아규먼트 사용법
// function my_sum_all() {
//     $numbers = func_get_args();
//     return array_sum($numbers);
// }

echo my_sum_all(4, 5, 7, 6, 3, 5);
echo "\n";

// 일반 파라미터와 가변 파라미터를 같이 쓸 경우
function test($param_str, ...$arr_str) {
    $str = "";
    foreach($arr_str as $val) {
        $str .= $val;
    }
    $str .= $param_str;
    echo $str;
}
test("젤뒤", "a", "B", "c");