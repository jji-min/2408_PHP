// 원본은 보존하면서 오름차순 정렬 해주세요.
const ARR1 = [6, 3, 5, 8, 92, 3, 7, 5, 100, 80, 40];

let copyArrl = [...ARR1];
let resultSort = copyArrl.sort((a, b) => a - b);
console.log(resultSort);
console.log(ARR1);

// 중복 제거
// 1. forEach(), includes() 이용 중복 제거
let duplicationArr = [];
copyArrl.forEach(val => {
    if(!duplicationArr.includes(val)) {
        duplicationArr.push(val);
    }
});
// 2. filter(), indexOf() 이용 중복 제거
// copyArrl = [3, 3, 5, 5, 6, 7, 8, 40, 80, 92, 100]
let duplicationArr2 = copyArrl.filter((val, idx) => {
    return copyArrl.indexOf(val) === idx; // indexOf는 제일 첫번째 index를 가져옴
    // val이 3이고, idx가 1일 때, indexOf(3)은 0임
});
// 3. Set 객체 중복 제거 - Set은 중복을 허용하지 않음
let duplicationArr3 = Array.from(new Set(copyArrl));
// new Set(copyArrl) -> 중복제거되서 들어감, 배열은 아니여서(Set으로 나옴) 배열로 바꿔줘야함

// let resultSort2 = [];
// ARR1.forEach(val => {
//     if(resultSort2.every(num => num !== val)) {
//         resultSort2.push(val);
//     }
// });

// ARR1.forEach(val => {
//     if(!resultSort2.includes(val)) {
//         resultSort2.push(val);
//     }
// });

// console.log(resultSort2.sort((a, b) => a - b));

// -------------------------------------------------------------------------------

// 짝수와 홀수를 분리해서 각각 새로운 배열 만들어 주세요.
const ARR2 = [5, 7, 3, 4, 5, 1, 2];

let resultEven = ARR2.filter(num => num % 2 === 0);
let resultOdd = ARR2.filter(num => num % 2 !== 0);
console.log(resultEven);
console.log(resultOdd);

const ODD = ARR2.filter(num => num % 2 !== 0);
const EVEN = ARR2.filter(num => num % 2 === 0);

const ODD2 = [];
const EVEN2 = [];

ARR2.forEach(val => {
    if(val % 2 === 0) {
        if(!EVEN2.includes(val)) {
            EVEN2.push(val);
        }
    } else {
        if(!ODD2.includes(val)) {
            ODD2.push(val);
        }
    }
});