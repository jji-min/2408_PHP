// -----------------
// Date 객체
// -----------------
const dayToKorean = day => {
    const ARR_DAY = ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'];
    // 배열의 방번호와 일치 시켜줌
    return ARR_DAY[day];
    
    // switch(day) {
    //     case 0:
    //         return '일요일';
    //     case 1:
    //         return '월요일';
    //     case 2:
    //         return '화요일';
    //     case 3:
    //         return '수요일';
    //     case 4:
    //         return '목요일';
    //     case 5:
    //         return '금요일';
    //     default:
    //         return '토요일';
    // }
    // switch로 하면 효율적이지 않음, 소스코드도 김
}

const addLpadZero = (num, length) => {
    return String(num).padStart(length, '0');
}
// 일일이 모두 적어주는 것보다 함수를 만들어 적용하는 것이 깔끔

// 현재 날짜 및 시간 획득
const NOW = new Date();
// const NOW2 = new Date();
// const NOW3 = new Date();
// NOW, NOW2, NOW3은 서로 다 다른거
const TEST = new Date('1990-01-01 00:00:00');

// getFullYear() : 연도만 가져오는 메소드(yyyy)
// getYear()은 쓰면 안됨
const YEAR = NOW.getFullYear(); // 2024
const YEAR2 = TEST.getFullYear(); // 1990

// getMonth() : 월을 가져오는 메소드, 0 ~ 11 반환
// 원래 월을 가져오려면 +1 해야함
// const MONTH = String(NOW.getMonth() + 1).padStart(2, '0');
const MONTH = addLpadZero(NOW.getMonth() + 1, 2);

// getDate() : 일을 가져오는 메소드
const DATE = addLpadZero(NOW.getDate(), 2);

// getHours() : 시를 가져오는 메소드
// 24시로 나옴
const HOUR = addLpadZero(NOW.getHours(), 2);

// getMinutes() : 분을 가져오는 메소드
const MINUTES = addLpadZero(NOW.getMinutes(), 2);

// getSeconds() : 초를 가져오는 메소드
const SECOND = addLpadZero(NOW.getSeconds(), 2);

// getMilliseconds() : 미리초를 가져오는 메소드
const MILLISECONDS = addLpadZero(NOW.getMilliseconds(), 3);

// getDay() : 요일을 가져오는 메소드, 0(일) ~ 6(토) 리턴
const DAY = NOW.getDay();

const FORMAT_DATE = `${YEAR}-${MONTH}-${DATE} ${HOUR}:${MINUTES}:${SECOND}.${MILLISECONDS}, ${dayToKorean(DAY)}`;
console.log(FORMAT_DATE);

// getTime() : UNIX Timestamp를 반환(미리초 단위)
console.log(NOW.getTime());

// 두 날짜의 차를 구하는 방법
// 많이 사용함
const TARGET_DATE = new Date('2025-03-13 18:10:00');
const DIFF_DATE = Math.floor(Math.abs(NOW - TARGET_DATE) / 86400000);
// 1000 * 60 * 60 * 24 = 86400000 (일 단위)

// 2024-01-01 13:00:00과 2025-05-30 00:00:00은 몇개월 후 입니까?
const TARGET_DATE2 = new Date('2024-01-01 13:00:00');
const TARGET_DATE3 = new Date('2025-05-30 00:00:00');
// const DIFF_DATE2 = Math.floor(Math.abs(TARGET_DATE2 - TARGET_DATE3) / 86400000 / 30); // 17
const DIFF_DATE2 = Math.floor(Math.abs(TARGET_DATE2 - TARGET_DATE3) / (1000 * 60 * 60 * 24 * 30)); // 17