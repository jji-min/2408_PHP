// ------------------
// 요소 선택
// ------------------
// 고유한 ID로 요소 선택
const TITLE = document.getElementById('title');
TITLE.style.color = 'blue'; // 해당 요소의 글자 색깔 변경

// 태그명으로 요소를 선택하는 방법
const H1 = document.getElementsByTagName('h1'); // HTMLCollction 객체, iterable한 객체
// 배열처럼 접근가능 -> H1[1]
H1[1].style.color = 'green';

// 클래스명으로 요소를 선택
const CLASS_NONE_LI = document.getElementsByClassName('none-li');

// 태그명, 클래스명으로 요소 선택하는 것은 반복처리등의 어려움이 있어 잘 사용하지 않음

// CSS 선택자를 이용해서 요소를 선택
// 해당하는 요소가 여러개 있으면 가장 첫번째꺼만 가져옴
const SICK = document.querySelector('#sick');
const NONE_LI = document.querySelector('.none-li');
const ALL_NONE_LI = document.querySelectorAll('.none-li'); // NodeList 객체

const LI = document.querySelectorAll('li');
LI.forEach((element, idx) => {
    if(idx % 2 === 0) {
        element.style.color = 'red';
    } else {
        element.style.color = 'blue';
    }
});

// -------------------
// 요소 조작
// -------------------
// textContent : 컨텐츠를 획득 또는 변경, 순수한 텍스트 데이터를 전달
TITLE.textContent = 'ttt'; // title의 content를 바꿀 수 있음
TITLE.textContent = '<a>링크</a>'; // -> a태그가 아닌 그냥 문자로 들어감

// innerHTML : 컨텐츠를 획득 또는 변경, 태그는 태그로 인식해서 전달
// TITLE.innerHTML = '<a href="https://www.naver.com">링크크크크</a>';
TITLE.innerHTML = '<a>링크크크크</a>'; // <h1 id = "title"><a>링크크크크</a></h1>

// setAttribute(속성명, 값) : 해당 속성과 값을 요소에 추가
const A_LINK = document.querySelector('#title > a');
A_LINK.setAttribute('href', 'https://www.naver.com');

const HAHAHA = document.querySelector('#input-1');
HAHAHA.setAttribute('placeholder', '하하하하하');

// document.querySelector('img').setAttribute('src','../img/cat.jfif'); // 이미지 추가

// removeAttribute(속성명) : 해당 속성 제거
A_LINK.removeAttribute('href');

// --------------------
// 요소의 스타일링
// --------------------
// style : 인라인으로 스타일 추가
TITLE.style.color = 'black'; // inline으로 스타일이 적용되서 우선수위가 높음
TITLE.removeAttribute('style');

// classList : 클래스로 스타일 추가 및 삭제
// classList.add() : 해당 클래스 추가
TITLE.classList.add('class-1');
TITLE.classList.add('class-2', 'class-3', 'class-4'); // 여러개 가능

// classList.remove() : 해당 클래스 제거
TITLE.classList.remove('class-3');

// classList.toggle() : 해당 클래스를 on/off
TITLE.classList.toggle('toggle');

// --------------------
// 새로운 요소 생성
// --------------------
// createElement(태그명) : 새로운 요소 생성
const NEW_LI = document.createElement('li');
NEW_LI.textContent = '떡볶이';
NEW_LI.style.color = 'blue';

const FOODS = document.querySelector('#foods');
// 기준점이 되는 아이에게 id를 주고, 다른 건 css 선택자를 적절하게 사용함

// appendChild(노드) : 해당 부모 노드의 마지막 자식으로 노드를 추가
FOODS.appendChild(NEW_LI);

// removeChild(노드) : 해당 부모 노드의 자식 노드를 삭제
FOODS.removeChild(NEW_LI);

// document.body // body는 다음과 같이 작성하면 body를 모두 가져옴
// 트리구조는 부모가 없어지면 밑에 자식도 함께 없어짐

// insertBefore(새로운노드, 기준노드) : 해당 부모 노드의 자식인 기준노드의 앞에 새로운 노드를 추가
FOODS.insertBefore(NEW_LI, SICK);