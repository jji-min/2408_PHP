<?php

try {
    echo "try문 시작";
    // 예외나 에러가 발생할 가능성이 있는 소스코드를 작성
    // 5 / 0;

    echo "try문 끝";
} catch(Throwable $th) {
    // try문에서 예외나 에러가 발생했을 때 실행할 소스코드 작성
    echo "catch 예외발생";
} finally {
    echo "finally"; // 예외가 발생하던 안하던 무조껀 실행 (파일 닫기 등에 사용)
}

// 5 / 0; // DivisionByZeroError 발생, try catch 문 없으면 에러난 시점에서 프로그램 종료됨

echo "처리 종료";