<?php
// PHP 내장함수

// ---------------
// trim(문자열) : 문자열의 좌우 공백을 제거해서 반환
$str = "   미어캣  ";
echo trim($str);
echo "\n";
$str = "   미어  캣  ";
echo trim($str);
echo "\n";

echo "----------------------\n";

// ---------------
// strtoupper(문자열), strtolower(문자열) : 문자열을 대/소문자로 변환해서 반환
// php 초기버전에 나온 함수라서 명명규칙에 맞지 않음
$str2 = "AbcDe";
echo strtoupper($str2);
echo strtolower($str2);
echo "\n";

echo "----------------------\n";

// ----------------
// strlen(문자열) : 문자열의 길이를 반환, 멀티바이트 문자열에 대응 못함
// mb_strlen(문자열) : 문자열의 길이를 반환, 멀티바이트 문자열에 대응
$str3 = "미  어  캣";
echo strlen($str3);   // 9출력 / byte수를 셈, 1byte문자는 제대로 인식하지만, 한글은 제대로 인식 못함, 요즘은 잘 사용하지 않음
echo mb_strlen($str3);  // 3출력 / 이걸 사용하는 것이 좋음, 정확한 문자열의 길이를 반환함, 띄어쓰기도 문자열로 인식
echo "\n";

echo "----------------------\n";

// -----------------
// str_replace(검색할문자열, 치환될 문자열, 대상 문자열) : 특정 문자를 치환해서 반환, 보통 문자열 자를 때 많이 사용
$str4 = "key: 3554ssdfksfkvba";
echo str_replace("key: ", "", $str4);
echo "\n";
echo str_replace("k", "케이", $str4);
echo "\n";

echo "----------------------\n";

// -----------------
// mb_substr(대상문자열, 자를 개수, 출력할 개수) : 문자열을 잘라서 반환
// substr()으로 하면 문자열 깨짐
$str5 = "PHP입니다.";
echo mb_substr($str5, 3);   // '출력할 개수' 생략 가능
echo "\n";
echo mb_substr($str5, 3, 1);    // 좌측부터 잘림, 잘린 다음부터 출력
echo "\n";
echo mb_substr($str5, -3, 2);    // 우측부터 잘림, 오른쪽부터 3번째에 해당하는 문자부터 출력할 개수만큼 출력
echo "\n";

echo "----------------------\n";

// ------------------
// mb_strpos(대상문자열, 검색할 문자열) : 검색할 문자열의 특정 위치를 반환
$str6 = "점심 뭐먹지?";
echo mb_strpos($str6, "뭐먹");    // 3 출력, 0부터 시작, 첫글자의 위치가 나옴, 대상문자열은 null이 들어갈 수 없음
echo "\n";
// "뭐"부터 3글자 잘라오기
echo mb_substr($str6, mb_strpos($str6, "뭐"), 3);
echo "\n";

echo "----------------------\n";

// -------------------
// sprintf(포맷문자열, 대입문자열1, 대입문자열2...) : 포맷 문자열에 대입문자열들을 순서대로 대입해서 반환
$str_format = "당신의 점수는 %.2f점입니다. <%s>";  // 양수 숫자 : %u, 음수를 포함한 모든 숫자 : %d, 실수 : %f(소수점 둘째자리까지면 %.2f), 문자 : %s

echo sprintf($str_format, 90.125, "A");
echo "\n";

echo "----------------------\n";

// -------------------
// isset(변수) : 변수가 설정되어 있는지 확인하여 true/false 반환
$str7 = ""; // 빈 문자열이라도 있는 상태
$str8 = null;   // 아무것도 없는 상태
var_dump(isset($str7)); // true
var_dump(isset($str8)); // false
var_dump(isset($no));   // false

echo "----------------------\n";

// --------------------------
// empty(변수) : 변수의 값이 비어있는지 확인해서 true/false 반환
$empty1 = "abc";
$empty2 = "";
$empty3 = 0;
$empty4 = [];
$empty5 = null;
var_dump(empty($empty1));   // false
var_dump(empty($empty2));   // true, 비어있는 문자열
var_dump(empty($empty3));   // true, 숫자 0을 없다고 인식
var_dump(empty($empty4));   // true, 빈 배열은 요소가 없어서
var_dump(empty($empty5));   // true

echo "----------------------\n";

// ---------------
// is_null(변수) : 변수가 null인지 아닌지 확인하여 true/false 반환
$chk_null = null;
var_dump(is_null($chk_null));   // true

echo "----------------------\n";

// ---------------
// gettype(변수) : 변수의 데이터 타입을 문자열로 반환
$type1 = "abc";
$type2 = 0;
$type3 = 1.2;
$type4 = [];
$type5 = true;
$type6 = null;
$type7 = new DateTime();
echo gettype($type1)."\n";  // string
echo gettype($type2)."\n";  // integer
echo gettype($type3)."\n";  // double
echo gettype($type4)."\n";  // array
echo gettype($type5)."\n";  // boolean
echo gettype($type6)."\n";  // NULL
echo gettype($type7)."\n";  // object

var_dump(gettype($type1));  // string

// 타입 체크 방법 예)
if(gettype($type2) === "integer") {
    echo "숫자임";
}

echo "----------------------\n";

// ---------------
// settype(변수, 데이터타입) : 변수의 데이터 타입을 변환
$type8 = "1";
var_dump((int)$type8);  // int / 원본은 변경하지 않고 캐스팅
var_dump($type8);   // string

settype($type8, "int"); // 원본의 데이터 타입을 변환
var_dump($type8);   // int

echo "----------------------\n";

// ---------------
// time() : 현재시간을 반환 (타임스탬프 초단위)
echo time();
echo "\n";

// ---------------
// date(시간포맷, 타임스탬프값) : 시간 포맷형식으로 문자열 반환
echo date("Y-m-d H:i:s", time());   // H : 24시 기준, h : 12시 기준
echo "\n";
echo date("Y/m/d", time());
echo "\n";

// ---------------
// ceil(변수), round(변수), floor(변수) : 각 올림, 반올림, 버림하여 반환
echo ceil(1.2)."\n";
echo round(1.5)."\n";
echo floor(1.2)."\n";

// ---------------
// random_int(시작값, 끝값) : 시작값부터 끝값까지의 랜덤한 숫자 반환
echo random_int(1, 10);