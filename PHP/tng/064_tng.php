<?php
// 로또 번호 생성기
// 1. 1 ~ 45 번호가 있다.
// 2. 랜덤한 번호 6개를 출력한다.
//  2-1. 단, 번호는 중복되지 않는다.

// 중복 번호 발생함 -> 변수명이 같아서...?
// $lotto = [];
// for($i = 0; $i < 6; $i++) {
//     $num = random_int(1, 45);
//     $lotto[$i] = $num;
//     for($z = 0; $z <= $i; $z++){
//         if($lotto[$z] === $num){
//             $num = random_int(1, 45);
//             $lotto[$i] = $num;
//         }
//     }
// }
// var_dump($lotto);

// 변수명이 문제가 아닌가....
// $lotto = [];
// for($i = 0; $i < 6; $i++) {
//     $num = random_int(1, 45);
//     $lotto[$i] = $num;
//     for($z = 0; $z <= $i; $z++){
//         $pastnum = $lotto[$i];
//         if($lotto[$z] === $pastnum){
//             $newnum = random_int(1, 45);
//             $lotto[$i] = $newnum;
//         }
//     }
// }
// var_dump($lotto);

// 중복이 안없어져...
// $lotto = [];
// for($i = 0; $i < 6; $i++) {
//     $num = random_int(1, 6);
//     $lotto[$i] = $num;
//     for($z = 0; $z <= $i; $z++) {
//         $pastnum = $lotto[$i];
//         if($lotto[$z] === $pastnum) {
//             $lotto[$i] = random_int(1, 6);
//         }
//     }
// }
// var_dump($lotto);

// 풀이

$arr = []; // 1~45수를 가지는 배열
$get_numbers = []; // 뽑은 숫자 저장용 배열

// 1~45의 값을 가지는 배열 생성
for($i = 1; $i <= 45; $i++) {
    $arr[$i - 1] = $i;
}

// 숫자 6개 뽑는 처리
for($i = 0; $i <6; $i++) {
    $random_num = random_int(0, 44); // 랜덤 index 생성(배열의 index)
    $random_pick = $arr[$random_num]; // 랜덤 index의 해당 값을 획득
    
    // 이미 뽑은 숫자인지 체크 처리
    $is_set_flg = false; // 분기용 플래그 초기화
    //이미뽑은 숫자 배열 루프
    foreach($get_numbers as $val) {
        // 이미 뽑은 숫자이면 분기용 플래그 true
        if($val === $random_pick) {
            $is_set_flg = true;
        }
    }

    // 분기용 플래그 체크
    if(!$is_set_flg) {
        // 중복되지 않는 숫자는 저장용 배열에 추가
        $get_numbers[] = $random_pick;
    } else {
        // 중복되는 경우 루프를 한번 더 돌도록 $i값 -1
        $i--;
    }
}

// 출력 처리
foreach($get_numbers as $val) {
    // echo $val." ";
}

// ----------------------------------------
// PHP 내장함수를 적극적으로 이용할 경우
// ----------------------------------------
$arr = range(1, 45); // 1~45의 수를 가지는 배열
$get_numbers = []; // 뽑은 숫자 저장용 배열

$random_key = array_rand($arr, 6); // 배열에서 랜덤한 키(6개) 획득

// 랜덤한 키를 루프
foreach($random_key as $val) {
    $get_numbers[] = $arr[$val]; // 키를 이용해서 값 삽입
}

echo implode(" ", $get_numbers); // 공백을 구분자로 배열을 스트링으로 출력