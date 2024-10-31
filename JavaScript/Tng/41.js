function ampm(hour) {
    let strHour = '';
    if(hour === 12) {
        strHour = '오후 ' + hour;
    } else if(hour === 24) {
        strHour = '오전 00';
    } else if(hour > 12) {
        strHour = '오후 ' + addLpadZero((hour - 12), 2);
    } else {
        strHour = '오전 ' + addLpadZero(hour, 2);
    }
    return strHour;
}

function addLpadZero(num, length) {
    return String(num).padStart(length, '0');
}

function getTime() {
    const NOW = new Date();
    const HOUR = ampm(NOW.getHours());
    // const HOUR = ampm(12);
    const MINUTE = addLpadZero(NOW.getMinutes(), 2);
    const SECOND = addLpadZero(NOW.getSeconds(), 2);
    
    const TIME = HOUR + ':' + MINUTE + ':' + SECOND;
    return TIME;
}

const SPAN = document.createElement('span');
const P = document.querySelector('p');
let intervalId = setInterval(() => {
    SPAN.textContent = getTime();
});
P.appendChild(SPAN);
// let idList = [];
// idList.push(intervalId);

const BTN_STOP = document.querySelector('#btn_stop');
BTN_STOP.addEventListener('click', () => {
    // idList.forEach(val => {
    //     clearInterval(val);
    // });
    // idList = [];
    // 이렇게 forEach문을 돌려서 해도되나...
    // 되긴 되는데 더 나은 방법이 있다고 함...ㅎ
    // 그게 뭔데

    clearInterval(intervalId);
    intervalId = null;
});

const BTN_RESTART = document.querySelector('#btn_restart');
BTN_RESTART.addEventListener('click', () => {
    if(!intervalId) {
        intervalId = setInterval(() => {
            SPAN.textContent = getTime();
        }, 1000);
    }
    // 또 되긴되네

    // idList.push(intervalId);
});