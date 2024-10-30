// const inlineEventBtn = () => {
    
// }
// 함수 표현식을 쓰면 함수 선언 전에 함수를 호출하면 에러남

// 함수 선언식
function inlineEventBtn() {
   alert('무한루프');
}

function changeColor() {
    // const H1 = document.getElementsByTagName('h1');
    // H1[0].style.color = 'red';

    // const TITLE = document.getElementById('title');
    // TITLE.style.color = 'blue';

    const TITLE = document.querySelector('#title');
    // 전역변수로 만들면 메모리상에 계속 올라가있기 때문에 메모리가 낭비됨
    // 요소 선택할 때 querySelector 쓰기!
    TITLE.style.color = 'blue';
}
// const TITLE = document.querySelector('h1');
// 전역변수로 선언했을 때, html은 위에서부터 순서대로 진행되기 때문에 h1을 찾지 못해 에러날 수 있음
// html에서 javascript를 부를 때 defer를 적어줘야함

// css의 class 이용
function changeTitle() {
    const TITLE = document.querySelector('h1');
    TITLE.classList.add('title-click');
}

// 누를때마다 색깔 바꾸기
function titleColor() {
    const COLOR1 = 'black';
    const COLOR2 = 'blue';
    const TITLE = document.querySelector('#title');
    if(TITLE.style.color === COLOR2) {
        TITLE.style.color = COLOR1;
    } else {
        TITLE.style.color = COLOR2;
    }
}
// inline으로 작성하면 html에 js코드가 들어가는 것이기 때문에 좋지 않음
// 요즘은 inline 잘 안씀

// addEventListener()
// 여러개의 동일한 이벤트 중복 작성 가능
// 순서대로 실행됨
const BTN_LISTENER = document.querySelector('#btn1');
// BTN_LISTENER.addEventListener('click', () => {
//     alert('이벤트 리스너 실행'); // 콜백 함수
// });
BTN_LISTENER.addEventListener('click', callAlert);
// 소괄호 붙이면 바로 실행되기 때문에 소괄호 붙이면 안됨

// removeEventListener()
// BTN_LISTENER.removeEventListener('click', () => {
//     alert('이벤트 리스너 실행');
//     // 이렇게 쓰면 사라지지 않음
//     // 서로 하나씩 만든거라 각자 다른 객체가 됨
// });
BTN_LISTENER.removeEventListener('click', callAlert);

function callAlert() {
    alert('이벤트 리스너 실행');
}

// BTN_LISTENER.addEventListener('click', () => {
//     alert('hohohohohohoho'); // 콜백 함수
// });

const BTN_TOGGLE = document.querySelector('#btn_toggle');
BTN_TOGGLE.addEventListener('click', () => {
    const TITLE = document.querySelector('h1');
    TITLE.classList.toggle('title-click');
});

// -------------
const H2 = document.querySelector('h2');
H2.addEventListener('click', testyong);
function testyong() {
    alert('테스트용'); // 확인버튼을 누르기 전까지는 다음 실행이 되지 않기 때문
    // H2.removeEventListener('click', testyong); // 딱 한번만 alert 실행되고 사라짐
}

const TITLE = document.querySelector('h1');
TITLE.addEventListener(
    'mouseenter'
    , () => {
        H2.removeEventListener('click', testyong); // title에 mouse가 한번이라도 진입하면 alert 실행안됨
        console.log('tt');
    }
    ,{once: true} // option : once가 true일 경우 한번만 실행, 객체로 넣어줘야 함
);

// 이벤트 객체
const H3 = document.querySelector('h3');
H3.addEventListener('mouseup', (e) => { // e안에 자동으로 이벤트 객체를 생성해서 저장함
    // console.log(e);
    e.target.style.color = 'red'; // e.target -> h3
});
H3.addEventListener('mousedown', (e) => {
    e.target.style.color = 'green';
});
H3.addEventListener('mouseenter', (e) => {
    e.target.style.color = 'blue';
});
H3.addEventListener('mouseleave', (e) => {
    e.target.style.color = 'orange';
});

// 모달
const BTN_MODAL = document.querySelector('#btn_modal');
BTN_MODAL.addEventListener('click', () => {
    const MODAL = document.querySelector('.modal-container');
    MODAL.classList.remove('display-none');
});
const MODAL_CLOSE = document.querySelector('#modal_close');
MODAL_CLOSE.addEventListener('click', () => {
    const MODAL = document.querySelector('.modal-container');
    MODAL.classList.add('display-none');
});

// 팝업
// 많이 사용하진 않음
const NAVER = document.querySelector('#naver');
NAVER.addEventListener('click', () => {
    // open('https://www.naver.com', '_blank', 'width=500 height=500'); // width, height 단위는 안적어도 됨, px기준
    // '', '_blank' -> 새 창, '_self' -> 현재창
    open('https://www.naver.com', '_blank', 'top=0 width=500 height=500');
    open('https://www.daum.net', '_blank', 'top=500 width=500 height=500');
    open('https://www.google.com', '_blank', 'left=500 width=500 height=500');
});