<?php

// 변수 (Variable)
$dan = "구구구구";

echo "$dan X 1 = 2\n";
echo "$dan X 2 = 4\n";
echo "$dan X 3 = 6\n";
echo "$dan X 4 = 8\n";
echo "$dan X 5 = 10\n";

// 변수 선언
$num;

// 변수 초기화
$num = 1;

// 변수 선언 및 초기화
$str = "가나다";

// 변수 명명 규칙
// - 변수명은 영문 대소문자,숫자,언더바(_) 사용 가능
// (’_’ 이 외의 특수기호 사용 불가능 / 한글은 사용 가능하나 지양)
// - 변수명은 숫자로 시작이 불가능
// - 변수명은 공백이 포함 불가
// - 변수명은 미리 지정되어 있는 예약어를 사용불가
// ex) $this, $_POST 등등
// - 변수명은 대소문자를 구분
// ex) $Num; 과 $num;은 서로 다른 변수로 인식

// --------------
// 네이밍 기법
// 스네이크 기법
$user_name;

// 카멜 기법
$userName;

// ---------------
$name = "강아지";
echo $name;
$name = "고양이";
echo $name;

// 상수 (constants)
define("AGE", 20);
echo AGE;
// define("AGE", 30); // 이미 선언된 상수이므로 Warning이 일어나고 값이 바뀌지 않음.

// underscore 표기법
$num = 10_000_000;
echo $num."\n";

// 아래처럼 변수 값을 담아서 출력해 주세요.
// 점심메뉴
// 탕수육 8,000
// 짜장면 6,000
// 짬뽕 6,000
$lunch = "점심메뉴\n";
$menu1 = "탕수육 8,000\n";
$menu2 = "짜장면 6,000\n";
$menu3 = "짬뽕 6,000\n";
echo $lunch;
echo $menu1;
echo $menu2;
echo $menu3;

$menu = "점심메뉴\n";
$tang = "탕수육 8,000\n";
$zza = "짜장면 6,000\n";
$zzam = "짬뽕 6,000\n";
echo $menu, $tang, $zza, $zzam;

// -------------
// 두 변수의 스왑
$num1 = 200;
$num2 = 10;
$tmp;

$tmp = $num1;
$num1 = $num2;
$num2 = $tmp;
echo $num1, $num2;


// ---------------
// 데이터 타입
// ---------------
// int : 정수
$num = 1;
var_dump($num);

// float, double : 실수
$double = 3.141592;
var_dump($double);

// string : 문자열
$str = "abc가나다";
var_dump($str);

// boolean : 논리값
$boo = true;
var_dump($boo);

// NULL : 널
$null = null;
var_dump($null);

// array : 배열
$arr = [1,2,3];
var_dump($arr);

// object : 객체
$obj = new DateTime();
var_dump($obj);

// 형변환
$casting = (string)$num;
var_dump($casting);