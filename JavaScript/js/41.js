// ------------------
// 타이머 함수
// ------------------

// setTimeout(callback, ms) : 일정 시간이 흐른 후에 콜백 함수를 실행
// 딱 한번만 실행함
// setTimeout(() => {
//     console.log('시간초과');
// }, 5000); // 5초 -> 5000ms

// C > B > A 순서로 출력, 총 3초 소요
// setTimeout(() => console.log('A'), 3000);
// setTimeout(() => console.log('B'), 2000);
// setTimeout(() => console.log('C'), 1000);

// // A > B > C 순서로 출력, 총 6초 소요
// setTimeout(() => {
//     console.log('A');
//     setTimeout(() => {
//         console.log('B');
//         setTimeout(() => {
//             console.log('C');
//         }, 1000);
//     }, 2000);
// }, 3000);
// 동기처럼 작동함
// 콜백 지옥

// 프로그래밍 언어는 보통 동기처리
// 동기 -> 이전의 처리가 완료되야 다음처리를 시작하는 것
// 비동기 -> 이전의 처리를 기다리지 않고 다음처리 시작
// 비동기 처리는 잘못 제어하면 버그가 많이 발생함
// 비동기 처리는 WebAPI에 맡김
// 비동기 : setTimeout, setInterval, addEventListener

console.log('A'); // console.log는 동기처리
setTimeout(() => console.log('B'), 1000); // 비동기이기 때문에 WebAPI에 넘김
console.log('C');
// A > C > B
// 마지막에 비동기 처리되는게 아니라 시간에 맞게 처리되는 것

// clearTimeout(타이머ID) : 해당 타이머ID의 처리를 제거(처리 자체를 실행안되게 없애버림)
const TIMER_ID = setTimeout(() => console.log('타이머'), 10000);
console.log(TIMER_ID);
// 1 출력 -> setTimeout()의 고유한 ID
clearTimeout(TIMER_ID); // 10초가 지나도 '타이머'가 찍히지 않음
// 버튼을 한번 누르면 1초 뒤에 누를 수 있게 한다는 등의 처리할 때 사용할 수 있음

// setInterval(callback, ms) : 일정 시간마다 콜백함수를 실행
// const INTERVAL_ID = setInterval(() => {
//     console.log('인터벌');
// }, 1000);

// clearInterval(id) : 해당 id의 인터벌을 제거
// clearInterval(INTERVAL_ID);

// setTimeout(() => clearInterval(INTERVAL_ID), 10000); // 10초 동안 '인터벌'이 출력되다가 제거됨

// '두둥등장'이 1초마다 빨강, 파랑 출력
const DOODOONG = document.createElement('p');
DOODOONG.textContent = '두둥등장';
DOODOONG.classList.add('color-red');
document.body.appendChild(DOODOONG);

setInterval(() => {
    DOODOONG.classList.toggle('color-blue');
}, 200);

(() => {
    const H1 = document.createElement('h1');
    H1.textContent = '두둥등장';
    H1.classList.add('color-blue');
    H1.style.fontSize = '5rem';

    document.body.appendChild(H1);
})();

setInterval(() => {
    const H1 = document.querySelector('h1');
    H1.classList.toggle('color-blue');
    H1.classList.toggle('color-red');
}, 200);

const K1 = '(ヘ･_･)ヘ┳━┳';
const K2 = '(╯°□°）╯︵ ┻━┻';
// const K2 = '(╯°□°）╯︵ <span style="color:brown">┻━┻</span>';
// span으로 컬러주고 innerHTML로 넣어주면 색깔도 바꿀 수 있음

(() => {
    const TEST = document.createElement('h2');
    TEST.textContent = K1;
    document.body.appendChild(TEST);
})();
setInterval(() => {
    const TEST = document.querySelector('h2');
    if(TEST.textContent === K1) {
        TEST.textContent = K2;
    } else {
        TEST.textContent = K1;
    }
}, 200);

// function face() {
//     document.body.removeChild(TEST);
//     const TEST2 = document.createElement('h2');
//     TEST2.textContent = ;
//     document.body.appendChild(TEST);
// }