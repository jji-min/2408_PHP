// Promise 객체

function iAmSleep(flg) {
    return new Promise((resolve, reject) => {
        if(flg) {
            resolve('성공'); // then으로
        } else {
            reject('실패'); // catch로
        }
    });
}
iAmSleep(true)
.then(data => console.log(data))
.catch(error => console.error(error))
.finally(() => console.log('파이널리')) // finally는 무조껀 실행됨
;
// catch와 finally는 필수 아님 


// setTimeout(() => {
//     console.log('A');
//     setTimeout(() => {
//         console.log('B');
//         setTimeout(() => {
//             console.log('C');
//         }, 1000);
//     }, 2000);
// }, 3000);

// // 프로미스 객체 생성
// function iAmSleepy(str, ms) {
//     return new Promise((resolve) => { // reject는 필요없으면 지워도 됨
//         setTimeout(() => {
//             console.log(str);
//             resolve(); // 비동기처리 완료했다는 리턴이 옴
//         }, ms);
//     });
// }

// // A > B > C 순으로 출력
// iAmSleepy('A', 3000)
// .then(() => iAmSleepy('B', 2000))
// .then(() => iAmSleepy('C', 1000));

// // A > C > B 순으로 출력
// iAmSleepy('A', 3000)
// .then(() => {
//     iAmSleepy('B', 2000);
//     iAmSleepy('C', 1000);
// });

// // 되긴하지만 가독성이 떨어지고, 콜백 지옥과 별반 다를게 없음...
// iAmSleepy('A', 3000)
// .then(
//     () => iAmSleepy('B', 2000)
//     .then(() => iAmSleepy('C', 1000))
// );