console.log('외부파일');

// -------- 변수 --------
// var : 중복 선언 가능, 재할당 가능, 함수레벨 스코프
var num1 = 1; // 최초 선언
var num1 = 2; // 중복 선언(개발자의 실수로 인해 버그가 발생할 가능성이 높아짐, 프로젝트 할때 사용 안하는게 좋을지도...)
num1 = 3; // 재할당
// num = 1; // 선언하지 않은 변수는 자동으로 var로 선언되어 오류 발생하지 않음

// let : 중복 선언 불가능, 재할당 가능, 블록레벨 스코프
let num2 = 2; // 최초 선언
// let num2 = 3; // 중복 선언, 불가능
num2 = 4; // 재할당

// const : 중복 선언 불가능, 재할당 불가능, 블록레벨 스코프, 상수
// 상수이기 때문에 대문자로 적음
const NUM3 = 3;
// NUM3 = 4; // 재할당, 불가능

// ---------------
// 스코프
// ---------------
// 변수나 함수가 유효한 범위
// 전역, 지역, 블록 3가지의 스코프

// 전역 레벨 스코프
let globalScope = '전역이다.';

function myPrint() {
    console.log(globalScope);
}

// 지역 레벨 스코프 (함수레벨 스코프도 지역 레벨 스코프임)
// 함수가 종료되면 함수내에서 선언했던 지역변수는 없어짐
function myLocalPrint() {
    let localScope = '마이로컬프린트 지역';
    console.log(localScope);
}

// 블록레벨 스코프 : {}로 둘러싸인 범위
function myBlock() {
    if(true) {
        var test1 = 'var'; // 함수레벨 스코프, 함수 내에서는 어디서든 사용가능
        let test2 = 'let'; // 블록레벨 스코프, if문 내에서만 가능
        const TEST3 = 'const'; // 블록레벨 스코프, if문 내에서만 가능
        // 일반적으로 if문 내에서 변수를 선언하지 않고 위에서 먼저 선언해두고 사용함
    }
    console.log(test1);
    console.log(test2);
    console.log(TEST3);
}

// ---------------
// 호이스팅 : 인터프리터가 변수와 함수의 메모리 공간을 선언 전에 미리 할당하는 것
// ---------------
// 일단 한번 쭉 읽고 미리 메모리 공간(방)을 만들어둠
// console.log(test); // var를 사용하면, 에러가 나지않고 undefined가 찍힘 -> undefined도 javascript의 데이터 타입 중 하나임
// test = 'aaa';
// console.log(test);
// var test;
// let test; // let을 쓰면 에러남, var를 쓸때 호이스팅 문제를 해결, 방은 똑같이 만들어주지만 선언하지 않았기 때문에 에러남
// var를 사용하지 않으면 이와 같은 문제가 발생하지 않음

// ---------------
// 데이터 타입
// ---------------
// number : 숫자
let num = 1;

// string : 문자열
let str = 'test';

// boolean : 논리
let bool = true;

// NULL : 존재하지 않는 값
let letNull = null;

// undefined : 값이 할당되지 않은 상태
let letUndefined;

// symbol : 고유하고 변경이 불가능한 값
let str1 = 'aaa';
let str2 = 'aaa';
// str1 === str2 -> true
let symbol1 = Symbol('aaa');
let symbol2 = Symbol('aaa');
// symbol1 === symbol2 -> false
// 객체(class)를 선언할 떄는 대문자로 시작

// object : 객체, 키-값 쌍으로 이루어진 복합 데이터 타입
let obj = {
    key1 : 'val1'
    ,key2 : 'val2'
}