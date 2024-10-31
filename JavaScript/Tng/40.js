// 1.`버튼` 클릭시 아래 문구 알러트로 출력
// 	  안녕하세요.
// 	  숨어있는 div를 찾아주세요.
// 2. 숨어있는 div에 마우스가 진입하면 아래 문구 알러트 출력
// 	- 두근두근
// 3. 숨어있는 div를 마우스로 클릭하면 아래 문구 알러트 출력 및 나타나기
// 	- 들켰다
// 4. 들킨 div에는 마우스가 진입해도 두근두근이 뜨지 않음
// 5. 나타난 div를 다시 클릭하면 아래 문구 알러트 출력 및 사라지기
// 	- 숨는다
// 6. 다시 숨은 div에 마우스가 진입하면 아래 문구 알러트 출력
//  - 두근두근

// -- 보너스 문제 --
// 다시 숨을 때 랜덤한 위치로 이동

// const BTN_FIND = document.querySelector('#btn_find');
// BTN_FIND.addEventListener('click', () => {
//     alert('안녕하세요.\n숨어있는 div를 찾아주세요.');
// });

// const BOX = document.querySelector('.box-hidden');
// BOX.addEventListener('mouseenter', dudu);
// function dudu() {
//     alert('두근두근❤');
// }

// BOX.addEventListener('click', find);

// function find() {
//     alert('들켰다👍');
//     BOX.classList.remove('color-transparent');
//     BOX.removeEventListener('mouseenter', dudu);
//     BOX.removeEventListener('click', find);
//     BOX.addEventListener('click', hide);
// }

// function hide() {
//     alert('다시 숨어야지^^');
//     randomNum();
//     randomCol();
//     BOX.classList.add('color-transparent');
//     BOX.addEventListener('mouseenter', dudu);
//     BOX.removeEventListener('click', hide);
//     BOX.addEventListener('click', find);
// }

// // 위치 랜덤
// function randomNum() {
//     const TOP = document.querySelector('.box-hidden');
//     let num1 = Math.floor(Math.random() * 1000) + 30;
//     let num2 = Math.floor(Math.random() * 1000) + 45;
//     TOP.style.top = num1 + 'px';
//     TOP.style.left = num2 + 'px';
// }

// // 배경색 랜덤
// // 좀 이상하게 돌아감...
// function randomCol() {
//     const COL_LIST = ['red', 'orange', 'yellow', 'green', 'blue'];
//     let color = COL_LIST[Math.floor(Math.random()*5)];
//     BOX.classList.toggle(color);
// }

// -----------------------
// 1.`버튼` 클릭시 아래 문구 알러트로 출력
(() => {
    const BTN_INFO = document.querySelector('#btn-info');
    BTN_INFO.addEventListener('click', () => { // 삭제할 일 없음
        alert('안녕하세요.\n숨어있는 div를 찾아주세요.');
    });

    // 2. 숨어있는 div에 마우스가 진입하면 아래 문구 알러트 출력
    const CONTAINER = document.querySelector('.container');
    CONTAINER.addEventListener('mouseenter', dokidoki);
    // addEventListener를 사용하면 WebAPI에 해당 코드를 올려둠

    // 3. 숨어있는 div를 마우스로 클릭하면 아래 문구 알러트 출력 및 나타나기
    const BOX = document.querySelector('.box');
    BOX.addEventListener('click', busted);

    // // 처음부터 위치 랜덤
    // // 즉시 실행 함수에도 쓰고 hide에서 사용하려면 따로 함수로 빼는 것이 좋음
    // const RANDOM_X = Math.round(Math.random() * (window.innerWidth - CONTAINER.offsetWidth));
    // const RANDOM_Y = Math.round(Math.random() * (window.innerHeight - CONTAINER.offsetHeight));
    // CONTAINER.style.top = RANDOM_Y + 'px';
    // CONTAINER.style.left = RANDOM_X + 'px';

    random();
})(); // -> 즉시 실행 함수
// 초기에 구축(세팅)해야하는게 있다면 즉시 실행 함수를 이용하는 것이 좋음

// 두근두근 함수
function dokidoki() {
    alert('두근두근💖');
}

// 들켰다 함수
function busted() {
    alert('들켰다.😒');
    const CONTAINER = document.querySelector('.container');
    const BOX = document.querySelector('.box');
    BOX.removeEventListener('click', busted);
    BOX.classList.add('busted'); // 배경색 부여

    // 5. 나타난 div를 다시 클릭하면 아래 문구 알러트 출력 및 사라지기
    BOX.addEventListener('click', hide); // 숨는다 이벤트 추가

    // 4. 들킨 div에는 마우스가 진입해도 두근두근이 뜨지 않음
    CONTAINER.removeEventListener('mouseenter', dokidoki); // 기존 두근두근 이벤트 제거
}

// 숨는다 함수
function hide() {
    alert('숨는다. (¬‿¬)');
    const CONTAINER = document.querySelector('.container');
    const BOX = document.querySelector('.box');

    BOX.classList.remove('busted'); // 들켰다 배경색 제거
    BOX.addEventListener('click', busted); // 들켰다 이벤트 추가
    BOX.removeEventListener('click', hide); // 숨는다 이벤트 제거

    // 6. 다시 숨은 div에 마우스가 진입하면 아래 문구 알러트 출력
    CONTAINER.addEventListener('mouseenter', dokidoki); // 두근두근 이벤트 추가

    // // -- 보너스 문제 --
    // // 다시 숨을 때 랜덤한 위치로 이동
    // // 브라우저의 범위를 넘어서지 않게 'x(전체 가로길이) - 해당div크기', 'y(전체 세로길이) - 해당div크기'로 위치를 조절해야함
    // const RANDOM_X = Math.round(Math.random() * (window.innerWidth - CONTAINER.offsetWidth));
    // // window.innerWidth -> 뷰포트의 가로길이, CONTAINER.offsetWidth -> 해당 가로길이
    // const RANDOM_Y = Math.round(Math.random() * (window.innerHeight - CONTAINER.offsetHeight));
    // CONTAINER.style.top = RANDOM_Y + 'px';
    // CONTAINER.style.left = RANDOM_X + 'px';
    // // console.log(RANDOM_X, RANDOM_Y); // 위치 확인

    random();
}

function random() {
    const CONTAINER = document.querySelector('.container');
    const RANDOM_X = Math.round(Math.random() * (window.innerWidth - CONTAINER.offsetWidth));
    const RANDOM_Y = Math.round(Math.random() * (window.innerHeight - CONTAINER.offsetHeight));
    CONTAINER.style.top = RANDOM_Y + 'px';
    CONTAINER.style.left = RANDOM_X + 'px';
}