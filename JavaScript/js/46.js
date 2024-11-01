// setTimeout(() => {
//     console.log('A');
//     setTimeout(() => {
//         console.log('B');
//         setTimeout(() => {
//             console.log('C');
//         }, 1000);
//     }, 2000);
// }, 3000);

// 프로미스 객체 생성
function iAmSleepy(str, ms) {
    return new Promise((resolve) => { // reject는 필요없으면 지워도 됨
        setTimeout(() => {
            console.log(str);
            resolve(); // 비동기처리 완료했다는 리턴이 옴
        }, ms);
    });
}

// iAmSleepy('A', 3000)
// .then(() => iAmSleepy('B', 2000))
// .then(() => iAmSleepy('C', 1000))
// .catch(() => console.log('error'))
// .finally(() => console.log('finally'));

async function test() {
    try {
        await iAmSleepy('A', 3000);
        await iAmSleepy('B', 2000);
        await iAmSleepy('C', 1000);
    } catch (error) {
        console.log('error');
    } finally {
        console.log('finally');
    }
}

test();