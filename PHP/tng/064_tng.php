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

$arr = [];
for($i = 1; $i <= 45; $i++) {
    $arr[$i - 1] = $i;
}