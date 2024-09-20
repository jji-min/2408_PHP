<?php
// // 구구단
// // **** 2단 ****
// // 2 X 1 = 2
// // ...
// for($i = 2; $i <= 9; $i++) {
//     echo "**** ".$i."단 ****\n";
//     for($z = 1; $z <= 9; $z++) {
//         echo $i." X ".$z." = ".($i * $z)."\n";
//     }
// }

// // 삼각형
// for($i = 1; $i <= 5; $i++) {
//     for($z = 1; $z <= $i; $z++) {
//         echo "*";
//     }
//     echo "\n";
// }

// for($i = 1; $i <= 5; $i++) {
//     for($z = 5 - $i; $z > 0; $z--) {
//         echo " ";
//     }
//     for($r = 1; $r <= $i; $r++) {
//         echo "*";
//     }
//     echo "\n";
// }

// // ------------------------------------------
// // function - 특정기능을 단위로 묶어 '모듈화'하여 코드의 '중복 제거'
// // 두수를 더해서 반환하는 함수
// function my_sum(int $num1, int $num2): int { // 파라미터 : 전달받은 값 저장
//     // int $num1 -> 타입힌트
//     // :int -> 리턴타입이 int
//     return $num1 + $num2;
// }

// echo my_sum(5, 8);  // 아규먼트(Args)
// echo "\n";

// function my_sum1(int $num1, int $num2 = 10): int {  // default 세팅
//     return $num1 + $num2;
// }

// echo my_sum1(5);

// // ---------------------------------
// // 예외처리 - 예외, 에러가 발생하면 동작이 멈춤 -> user화면에 서버 경로 등 중요한 정보들이 나옴
// try {
//     // 처리하고자 하는 로직
//     5 / 0;
// } catch(Throwable $th) { // php7버전 이후부터 Throwable 가능, 이전버전은 Exception 사용
//     // 예외 발생시 할 처리
//     echo $th->getMessage();
// } finally {
//     // 예외의 발생여부와 상관없이 항상 실행 할 처리
//     echo "파이널리";
// }

// echo "처리끝";

// try {
//     // 5 / 0;
//     echo "바깥쪽 try\n";
//     // 5 / 0;

//     try {
//         5 / 0;
//         echo "안쪽 try\n";
//     } catch(Throwable $th) {
//         echo "안쪽 catch\n";
//         5 / 0;  // 바깥쪽 try문에 해당
//         // 보통 catch문에는 에러가 발생하지 않는 코드를 작성해야하고 에러메시지나 에러페이지로 이동시킴
//     }
// } catch(Throwable $th) {
//     echo "바깥쪽 catch\n";
// }
// // 오류난 코드를 감싸고 있는 try, catch문에만 해당

// ---------------------------------
// 강제 예외 발생
try {
    throw new Exception("강제 예외 발생");  // Exception이 예외 중에 최상위, Throwable은 인터페이스

    echo "try"; // 위에서 강제로 예외를 발생 시켜 해당 코드는 실행이 안됨
} catch(Throwable $th) {
    echo $th->getMessage();
}
echo "\n";

// --------------------------------
// 형변환
$num = 1;
var_dump((string)$num); // 일회성


// 로또랜덤번호 뽑기(중복X)
// 지렁이가 낮에 3cm 올라가고, 밤에 2cm 떨어짐. 10cm올라가는데 얼마나 걸리는가 -> 8일