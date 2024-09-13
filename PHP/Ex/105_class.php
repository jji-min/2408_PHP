<?php
require_once("./Whale.php");    // 클래스 포함된 파일 불러옴

// breath();   // 클래스 내부에 있는 함수라서 함수명만으로는 외부에서 접근 불가

// 인스턴스화
// 메모리에 올려줌
$whale = new Whale();

// Class의 메소드 사용
$whale->breath();

// 프로퍼티 접근
echo $whale->name;  // 프로퍼티명만 적으면 됨
// echo $whale->age;   // private이기 때문에 외부에서 접근안됨
echo $whale->info();

// 스테틱 멤버에 접근
// 인스턴스화 하지않아도 스테틱은 접근 가능
Whale::myStatic();

require_once("./Shark.php");
// 상어 클래스
$shark = new Shark("상어");   // construct 실행
echo $shark->name;