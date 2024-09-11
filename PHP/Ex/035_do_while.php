<?php
// do_while : 무조건 한번은 실행하고 조건은 체크하는 반복문

$cnt = 1;

// 조건 체크하고 실행
while($cnt < 1) {
    echo "와일문";  // 출력되지 않음
}

// 일단 실행하고 조건 체크
do  {
    echo "두 와일문";
} while($cnt < 1);