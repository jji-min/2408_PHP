// 함수 쓰는 이유 : 유지보수 쉽게 하기 위해서, 관리하기 용이
// 함수 : 특정값을 넣으면 해당 계산식을 처리하여 값을 출력
// ---------------
// 함수 선언식
// 호이스팅에 영향을 받음
// 재할당 가능하므로 함수명 중복 안되게 조심해야 함, javascript는 함수명이 같아도 에러 안남
// ---------------
console.log(mySum(4, 5, 1));

function mySum(a, b) {
    return a + b;
}

// function mySum(a, b, c) {
//     return a + b + c;
// }

// ---------------
// 함수 표현식
// 호이스팅에 영향을 받지 않는다.
// 재할당을 방지
// 함수 표현식을 사용할 때는 const를 사용함
// ---------------

// console.log(myPlus(1, 2)); // 에러남

const myPlus = function(a, b) { 
    // function(a, b) - 익명 함수
    return a + b;
}

// ---------------
// 화살표 함수
// 현업에서 많이 사용함
// ---------------
// 파라미터가 2개 이상일 경우 (소괄호 생략 불가)
const arrowFnc = (a, b) => a + b;
function test1(a, b) {
    return a + b;
}
// 처리해야 하는게 한줄이 아니면 '{}' 필요함

// 파라미터가 1개일 경우 (소괄호 생략 가능)
const arrowFnc2 = a => a;
function test2(a) {
    return a;
}

// 파라미터가 없는 경우 (소괄호 생략 불가)
const arrowFnc3 = () => 'test';
function test3() {
    return 'test';
}

// 처리가 여러줄일 경우 ('{}'와 return 생략 불가)
const arrowFnc4 = (a, b) => {
    if(a < b) {
        return 'b가 더 큼';
    } else {
        return 'a가 더 큼';
    }
}
function test4(a, b) {
    if(a < b) {
        return 'b가 더 큼';
    } else {
        return 'a가 더 큼';
    }
}

// 이런것도 됨
// 함수안에서 함수 선언은 되지만 다른 함수 호출은 안됨
function test4(a, b) {
    function test6() {
        console.log(1);
    }
    test6();
    if(a < b) {
        return 'b가 더 큼';
    } else {
        return 'a가 더 큼';
    }
}

// ---------------
// 즉시 실행 함수
// ---------------
const execFnc = (function(a, b) {
    return a + b;
})(5, 6);
// 정의되면서 동시에 실행시킴
// 딱 한번만 호출됨

// ---------------
// 콜백 함수
// 다른 함수의 파라미터로 전달되어 특정 조건에 따라 호출되는 함수
// ---------------
function myCallBack() {
    console.log('myCallBack');
}

function myChkPrint(callBack, flg) {
    if(flg) {
        callBack();
    }
}

myChkPrint(myCallBack, true);
myChkPrint(() => 'ttt', true);