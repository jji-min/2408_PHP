// ------------------
// 배열
// ------------------
// PHP는 타입상관없이 다 들어감, 키 사이에 순서가 없음
// 다른 언어들은 데이터의 순서가 정해져 있음
const ARR1 = [1, 2, 3, 4, 5]; // ARR1[2]로 접근 가능, ARR1은 객체
const ARR2 = new Array(1, 2, 3, 4, 5); // 위와 같이 생략하여 작성할 수 있음
// Array.ARR1.isArray(); // 다음과 같이 사용할 수 없음

// push()
// 원본 배열의 마지막 요소를 추가, 리턴은 변경된 length, 원본변경(원본이 변경되지 않는 메소드도 있음)
ARR1.push(10); // '.'으로 접근, 무조껀 마지막에 추가됨
// ARR1의 부모는 Array -> 부모가 가진 요소 사용 가능

// length
// 배열의 길이 획득
console.log(ARR1.length); // 메소드가 아닌 프로퍼티여서 () 필요없음

// isArray()
// 배열인지 아닌지 체크
console.log(Array.isArray(ARR1)); // true 출력
console.log(Array.isArray(1)); // false 출력

// indexOf()
// 배열에서 특정 요소를 검색하고, 해당 인덱스를 반환
let i = ARR1.indexOf(4);
let j = ARR1.indexOf(20); // 없는 값을 넣으면 -1이 출력됨, -1을 이용하여 해당값이 있는지 없는지 체크할 수 있음
// 값이 중복되어 있다면 해당 값의 첫번째 위치의 인덱스를 반환함
console.log(i);

// includes()
// 배열의 특정 요소의 존재여부를 체크, boolean 리턴
let arr1 = ['홍길동', '갑순이', '갑돌이'];
let boo = arr1.includes('갑순이'); // true
console.log(boo);

// push()
// 원본 배열의 마지막 요소를 추가, 리턴은 변경된 length, 원본변경
ARR1.push(20, 30, 50); // 여러개 가능
// 속도가 느려질 가능성이 매우 큼
// 성능이슈 발생시 length를 이용해서 직접 요소를 추가할 것
// 무한 스크롤 기능 넣을 때 활용가능
ARR1[ARR1.length] = 100; // 성능이슈가 잘 생기지 않는 방법, ARR1.length : 마지막에 새로운 방 추가 

// 배열 복사
// 객체는 기본적으로 얕은 복사가 되므로 딥카피를 하기 위해서 Spread Operator를 이용
let num1 = 1;
let num2 = num1; // 값 복사
num2 = 3; // num1 : 1, num2 : 3

// 배열은 객체 -> 값을 그대로 복사하는 것이 아니라 기존에 있던 애를 참조함(원본을 읽어오기만 함)

// 얕은 복사, shallow copy
// 원본의 주소값을 가져옴, 참조
const COPY_ARR1 = ARR1;
COPY_ARR1.push(9999); // ARR1에도 9999가 들어가 있음
// 깊은 복사, deep copy
// 값 자체를 가져와서 복사, 원본을 보호하려면 deep copy를 해야함
const COPY_ARR2 = [...ARR1];
COPY_ARR2.push(8888);

// pop()
// 원본 배열의 마지막 요소를 제거, 제거된 요소 반환, 원본변경
// 제거할 요소가 없으면 undefined를 반환, null이 되는게 아니라 빈 배열([], length : 0)이 됨
// undefined는 null과 다름
const ARR_POP = [1, 2, 3, 4, 5];
let result_pop = ARR_POP.pop();
console.log(result_pop);
// ARR_POP.length = 2; // 작동하긴 하지만 원리를 모르고 사용하다가 언젠간 버그가 날지도...안 쓰는게 좋음

// unshift()
// 원본 배열의 첫번째 요소를 추가, 변경된 length 반환, 원본변경
const ARR_UNSHIFT = [1, 2, 3];
let resultUnshift = ARR_UNSHIFT.unshift(100); // 4출력, ARR_UNSHIFT = [1, 2, 3, 4]
console.log(resultUnshift);
ARR_UNSHIFT.unshift(222, 333, 444); // 여러개도 추가 가능

// shift()
// 원본 배열의 첫번째 요소를 제거, 제거된 요소 반환, 원본변경
// 제거할 요소가 없으면 undefined 반환
const ARR_SHIFT = [1, 2, 3, 4];
let resultShift = ARR_SHIFT.shift();
console.log(resultShift);

// splice()
// 요소를 잘라서 자른 배열을 반환, 원본변경
let arrSplice = [1, 2, 3, 4, 5];
let resultSplice = arrSplice.splice(2); // start가 2(인덱스 번호)
console.log(resultSplice); // 잘려나간 배열 [3, 4, 5]
console.log(arrSplice); // [1, 2]
// 시작을 음수로 할 경우
arrSplice = [1, 2, 3, 4, 5];
resultSplice = arrSplice.splice(-2); // 우측부터 2개 자름
console.log(resultSplice); // [4, 5]
console.log(arrSplice); // [1, 2, 3]
// start, count를 모두 셋팅할 경우
arrSplice = [1, 2, 3, 4, 5];
resultSplice = arrSplice.splice(1, 2);
console.log(resultSplice); // [2, 3]
console.log(arrSplice); // [1, 4, 5]
// 배열의 특정 위치에 새로운 요소 추가
arrSplice = [1, 2, 3, 4, 5];
resultSplice = arrSplice.splice(2, 0, 999, 888); // 잘려나가지 않게 count를 0으로, 3번째 이후 파라미터부터 ','로 여러개 가능
console.log(resultSplice); // 잘려나가는건 없음
console.log(arrSplice); // [1, 2, 999, 888, 3, 4, 5]
// 배열에서 특정요소를 새로운 요소로 변경
arrSplice = [1, 2, 3, 4, 5];
resultSplice = arrSplice.splice(2, 1, 999);
console.log(resultSplice);
console.log(arrSplice);

// join()
// 배열의 요소들을 특정 구분자로 연결한 문자열을 반환
// php의 explode와 같은 기능
let arrJoin = [1, 2, 3, 4];
let resultJoin = arrJoin.join(', '); // join은 return 값이 문자열
console.log(resultJoin); // 1, 2, 3, 4 -> string
console.log(arrJoin); // 원본배열은 그대로

// sort()
// 배열의 요소를 오름차순 정렬, 원본변경
// 파라미터를 전달하지 않을 경우에, 문자열로 변환 후에 정렬
let arrSort = [5, 6, 7, 3, 2, 20];
// let resultSort = arrSort.sort(); // 비교할 때 문자열로 변환해서 비교함, 데이터 타입이 바뀌진 않음
let resultSort = arrSort.sort((a, b) => a - b); // 오름차순
// let resultSort = arrSort.sort((a, b) => b - a); // 내림차순
// 값이 음수면 위치를 바꾸지 않고, 값이 양수면 위치를 서로 바꿈
console.log(resultSort);
console.log(arrSort);

// map()
// 배열의 모든 요소에 대해서 콜백 함수를 반복 실행한 후, 그 결과를 새로운 배열로 반환
let arrMap = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
let resultMap = arrMap.map(num => { // 화살표 함수
    if(num % 3 === 0) {
        return '짝';
    } else {
        return num;
    }
}); // 요소 하나씩 가져와서 콜백함수 실행
console.log(resultMap);
console.log(arrMap);

// 콜백 로직
const TEST = {
    entity: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
    ,length: 10
    ,map: function (callback) {
        let resultArr = []; // return할 값 저장할 공간
        for(let i = 0; i < this.entity.length; i++) { // 0부터 9까지
            resultArr[resultArr.length] = callback(this.entity[i]);
            // resultArr.push(callback(this.entity[i])); // push로도 가능하지만 성능이슈가 있음
        }
        return resultArr;
    }
}
// map을 통해서 뒤늦게 호출되서 실행됨

let resultTest = TEST.map(testCallback);

function testCallback(num) {
    if(num % 3 === 0) {
        return '짝';
    } else {
        return num;
    }
}

function myCallback() {
    return 'myCallback';
}
function myCallback2() {
    return 'myCallback2';
}

function test(callback, flg) {
    if(flg) {
        console.log(callback());
    } else {
        console.log('콜백 실행 안됨');
    }
}
// 상황에 따라 함수가 호출되기도 하고 안되기도 함
// 다른 함수에게 파라미터로 함수를 넘겨줌

// filter()
// 배열의 모든요소에 대해 콜백 함수를 반복 실행하고, 조건에 만족한 요소만 배열로 반환
// 3의 배수
let arrFilter = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
let resultFilter = arrFilter.filter(num => num % 3 === 0); // 콜백함수의 return이 boolean 형태여야 함
console.log(resultFilter);
// 3의 배수와 4의 배수를 동시에 반환
let resultFilter2 = arrFilter.filter(num => {
    if(num % 3 === 0 || num % 4 === 0) {
        return true;
    } else {
        return false;
    }
});
console.log(resultFilter2);

// some()
// 배열의 모든 요소에 대해 콜백 함수를 반복 실행하고,
// 조건에 만족하는 결과가 하나라도 있으면 true,
// 만족하는 결과가 하나도 없으면 false를 리턴
let arrSome = [1, 2, 3, 4, 5];
let resultSome = arrSome.some(num => num === 5); // true
console.log(resultSome);

// every()
// 배열의 모든 요소에 대해 콜백 함수를 반복 실행하고,
// 조건에 모든 결과가 만족하면 true,
// 하나라도 만족하지 않으면 false
let arrEvery = [1, 2, 3, 4, 5];
// let resultEvery = arrEvery.every(num => num === 5); // false
let resultEvery = arrEvery.every(num => num <= 5); // true
console.log(resultEvery);

// forEach()
// 배열의 모든 요소에 대해 콜백 함수를 반복 실행
let arrForeach = [1, 2, 3, 4, 5];
arrForeach.forEach((val, idx) => {
    // console.log(idx + ' : ' + val);
    console.log(`${idx} : ${val}`); // ``쓰려면 ${변수명} 필수
});


// * 문자열을 배열로 만듬, Array.from()
let str = 'hello';
let arrStr = Array.from(str);
console.log(arrStr);