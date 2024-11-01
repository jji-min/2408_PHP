// function ampm(hour) {
//     let strHour = '';
//     if(hour === 12) {
//         strHour = '오후 ' + hour;
//     } else if(hour === 24) {
//         strHour = '오전 00';
//     } else if(hour > 12) {
//         strHour = '오후 ' + addLpadZero((hour - 12), 2);
//     } else {
//         strHour = '오전 ' + addLpadZero(hour, 2);
//     }
//     return strHour;
// }

// function addLpadZero(num, length) {
//     return String(num).padStart(length, '0');
// }

// function getTime() {
//     const NOW = new Date();
//     const HOUR = ampm(NOW.getHours());
//     // const HOUR = ampm(12);
//     const MINUTE = addLpadZero(NOW.getMinutes(), 2);
//     const SECOND = addLpadZero(NOW.getSeconds(), 2);
    
//     const TIME = HOUR + ':' + MINUTE + ':' + SECOND;
//     return TIME;
// }

// const SPAN = document.createElement('span');
// const P = document.querySelector('p');
// let intervalId = setInterval(() => {
//     SPAN.textContent = getTime();
// });
// P.appendChild(SPAN);
// // let idList = [];
// // idList.push(intervalId);

// const BTN_STOP = document.querySelector('#btn_stop');
// BTN_STOP.addEventListener('click', () => {
//     // idList.forEach(val => {
//     //     clearInterval(val);
//     // });
//     // idList = [];
//     // 이렇게 forEach문을 돌려서 해도되나...
//     // 되긴 되는데 더 나은 방법이 있다고 함...ㅎ
//     // 그게 뭔데

//     clearInterval(intervalId);
//     intervalId = null;
// });

// const BTN_RESTART = document.querySelector('#btn_restart');
// BTN_RESTART.addEventListener('click', () => {
//     if(!intervalId) {
//         intervalId = setInterval(() => {
//             SPAN.textContent = getTime();
//         }, 1000);
//     }
//     // 또 되긴되네

//     // idList.push(intervalId);
// });

// ------------------------------------------
function leftPadZero(target, length) {
    return String(target).padStart(length, '0');
}
function getDate() {
    const NOW = new Date(); // 인스턴스화
    let hour = NOW.getHours(); // 시간 획득(24시 포멧)
    let minute = NOW.getMinutes(); // 분 획득
    let second = NOW.getSeconds(); // 초 획득
    let ampm = hour < 12 ? '오전' : '오후'; // 오전, 오후
    let hour12 = hour < 13 ? hour : hour - 12; // 시간(12시 포멧)

    let timeFormat = 
        `${ampm} ${leftPadZero(hour12, 2)}:${leftPadZero(minute, 2)}:${leftPadZero(second, 2)}`;
    document.querySelector('#time').textContent = timeFormat;
}

(() => {
    getDate(); // 바로 실행되게 하기 위해
    let intervalId = null; // 초기값을 잡아주는 이유 -> 직관적으로 코드를 알 수 있게
    // 불필요한 코드 적는 이유 -> 가독성을 위해
    intervalId = setInterval(getDate, 500); // 어디서든 접근할 수 있게 전역변수로 지정
    // WebAPI로 전달하는것이 통신을 하는 것 -> 여기서 딜레이 발생함 -> 1000을 주지 않고 500을 주면 그 오차를 좀 줄일 수 있음

    // 멈춰 버튼
    document.querySelector('#btn-stop').addEventListener('click', () => {
        clearInterval(intervalId);
        intervalId = null;
    });

    // 재시작 버튼
    document.querySelector('#btn-restart').addEventListener('click', () => {
        getDate(); // 바로 실행되게 하기 위해
        if(intervalId === null) {
            intervalId = setInterval(getDate, 500);
        }
    });
})();