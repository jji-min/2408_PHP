<?php
// for 문 : 특정 처리를 반복적으로 구현하고자 할 때 사용

// 0 ~ 5까지 숫자를 출력
// echo "0"."\n";
// echo "1"."\n";
// echo "2"."\n";
// echo "3"."\n";
// echo "4"."\n";
// echo "5"."\n";

// for($i = 1; $i < 6; $i++) {
//     // 우리가 반복하고 싶은 처리
//     echo "숫자 : ".$i."\n";
// }

// 조건을 잘못 주면 무한 반복 발생할 수 있음
// for($i = 1; $i > 0; $i++) {
//     // 우리가 반복하고 싶은 처리
//     echo "숫자 : ".$i."\n";
// }

// -------------------------------------------------------------
// break : 처리 중에 break를 만나면 루프 종료
// for($i = 1; $i < 6; $i++) {
//     // 우리가 반복하고 싶은 처리
//     echo "숫자 : ".$i."\n";
//     break;  // 숫자 : 1 만 출력
// }

// for($i = 1; $i < 6; $i++) {
//     if($i === 3) {
//         break;  // i가 3이면 종료
//     }
//     // 우리가 반복하고 싶은 처리
//     echo "숫자 : ".$i."\n";
// }

// for($i = 1; $i < 6; $i++) {
//     echo "숫자 : ".$i."\n";
//     if($i === 3) {
//         break;  // i가 3이면 3까지 출력하고 종료
//     }
// }

// ------------------------------------------------------------
// continue 문 : 처리 중에 continue를 만나면 이후의 처리를 건너뛰고 다음 루프 진행
for($i = 1; $i < 6; $i++) {
    continue;   // 아무것도 출력 안됨

    // 우리가 반복하고 싶은 처리
    echo "숫자 : ".$i."\n";
}

// 홀수만 출력
for($i = 1; $i < 6; $i++) {
    if(($i % 2) === 0) {
        continue;
    }

    // 우리가 반복하고 싶은 처리
    echo "숫자 : ".$i."\n";
}
// 순서 바꾸면 모두 출력됨
for($i = 1; $i < 6; $i++) {
    // 우리가 반복하고 싶은 처리
    echo "숫자 : ".$i."\n";
    if(($i % 2) === 0) {
        continue;
    }
}

// 짝수만 출력
for($i = 1; $i < 6; $i++) {
    if(($i % 2)) {
        continue;
    }

    // 우리가 반복하고 싶은 처리
    echo "숫자 : ".$i."\n";
}

for($i = 0; $i < 6; $i++) {
    if(($i % 2) === 1) {
        continue;
    }

    // 우리가 반복하고 싶은 처리
    echo "숫자 : ".$i."\n";
}
// 0을 나눌 수는 있지만, 0으로 나누는 것은 불가능

// 6 ~ 1까지 출력
for($i = 6; $i > 0; $i--) {
    // 우리가 반복하고 싶은 처리
    echo "숫자 : ".$i."\n";
}

// 구구단 2단 출력
// 2 X 1 = 2
// 2 X 2 = 4
// 2 X 3 = 6
// ...
// 2 X 9 = 18
echo "구구단 2단\n";
for($i = 1; $i <= 9; $i++) {
    echo "2 X ".$i." = ".(2 * $i)."\n";
}
echo "------------------\n";
// 2*$i를 하나의 변수명으로 인식하는데 변수명과 맞지 않기 때문에 에러가 뜸
// 소괄호()로 감싸줘야함.

// 변수 사용
echo "구구단 2단\n";
for($i = 1; $i <= 9; $i++) {
    $result = 2 * $i;
    echo "2 X ".$i." = ".$result."\n";
}
echo "------------------\n";

// 3단, 4단 등으로 바꾸기 쉽게 변수 지정
$dan = 2;
for($i = 1; $i <= 9; $i++) {
    echo $dan." X ".$i." = ".($dan * $i)."\n";
}
echo "------------------\n";

// --------------------------------------
// 다중 루프문
// --------------------------------------
for($i = 1; $i < 3; $i++) {
    echo "바깥 LOOP문 : ".$i,"\n";

    for($z = 1; $z < 3; $z++) {
        echo "안쪽 LOOP문 : z값 = ".$z.", i값 = ".$i."\n";
    }
}
echo "------------------\n";

// 구구단 2~9단을 출력
// 예시)
// ** 2단 **
// 2 X 1 = 2
// 2 X 2 = 4
// ...
// ** 3단 **
// 3 X 1 = 3
// 3 X 2 = 6
// ...
// 9 X 8 = 72
// 9 X 9 = 81
for($dan = 2; $dan <= 9; $dan++) {
    echo "** ".$dan."단 **\n";

    for($multi = 1; $multi <= 9; $multi++) {
        echo $dan." X ".$multi." = ".($dan * $multi)."\n";
    }
}
echo "------------------\n";

// 아래처럼 별을 찍어주세요.
// 예시)
// *****
// *****
// *****
// *****
// *****
for($line = 0; $line < 5; $line++) {
    for($star = 0; $star < 5; $star++) {
        echo "*";
    }
    echo "\n";
}
echo "------------------\n";

// 위에꺼 심플하게
for($line = 0; $line < 5; $line++) {
    echo "*****\n";
}
echo "------------------\n";

for($i = 1; $i <= 5; $i++) {
    echo "*****\n";
}
echo "------------------\n";

// 아래처럼 별을 찍어주세요.
// 예시)
// *
// **
// ***
// ****
// *****
for($i = 1; $i <= 5; $i++) {
    for($z = 1; $z <= $i; $z++) {
        echo "*";
    }
    echo "\n";
}
echo "------------------\n";

// 삼각형 반대로
// *****
// ****
// ***
// **
// *
for($i = 0; $i < 5; $i++) {
    for($z = 0; $z < 5 - $i; $z++){
        echo "*";
    }
    echo "\n";
}
echo "------------------\n";

// 아래처럼 별을 찍어주세요.
// 예시)
//     *
//    **
//   ***
//  ****
// *****
for($i = 1; $i <= 5; $i++) {
    for($z = 1; $z <= 5 - $i; $z++) {
        echo " ";
    }
    for($y = 1; $y <= $i; $y++) {
        echo "*";
    }
    echo "\n";
}

// 변수 생성
$num = 7;
for($i = 1; $i <= $num; $i++) {
    for($z = 1; $z <= $num - $i; $z++) {
        echo " ";
    }
    for($y = 1; $y <= $i; $y++) {
        echo "*";
    }
    echo "\n";
}

$num = 10;
for($i = 1; $i <= $num; $i++) {
    for($z = $num - $i; $z > 0; $z--) {
        echo " ";
    }
    for($k = 1; $k <= $i; $k++) {
        echo "*";
    }
    echo "\n";
}
echo "------------------\n";

// 구구단 6단 - 시간 5분
$dan = 6;
for($i = 1; $i <= 9; $i++) {
    echo $dan." X ".$i." = ".($dan * $i)."\n";
}

// TODO : for문 작품 [별 만들기] & [원 만들기]
// 다음시간에....