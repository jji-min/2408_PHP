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

const BTN_FIND = document.querySelector('#btn_find');
BTN_FIND.addEventListener('click', () => {
    alert('안녕하세요.\n숨어있는 div를 찾아주세요.');
});

const BOX = document.querySelector('.box-hidden');
BOX.addEventListener('mouseenter', dudu);
function dudu() {
    alert('두근두근❤');
}

BOX.addEventListener('click', find);

function find() {
    alert('들켰다👍');
    BOX.classList.remove('color-transparent');
    BOX.removeEventListener('mouseenter', dudu);
    BOX.removeEventListener('click', find);
    BOX.addEventListener('click', hide);
}

function hide() {
    alert('다시 숨어야지^^');
    randomNum();
    randomCol();
    BOX.classList.add('color-transparent');
    BOX.addEventListener('mouseenter', dudu);
    BOX.removeEventListener('click', hide);
    BOX.addEventListener('click', find);
}

// 위치 랜덤
function randomNum() {
    const TOP = document.querySelector('.box-hidden');
    let num1 = Math.floor(Math.random() * 100) + 30;
    let num2 = Math.floor(Math.random() * 100) + 45;
    TOP.style.top = num1 + 'px';
    TOP.style.left = num2 + 'px';
}

// 배경색 랜덤
// 좀 이상하게 돌아감...
function randomCol() {
    const COL_LIST = ['red', 'orange', 'yellow', 'green', 'blue'];
    let color = COL_LIST[Math.floor(Math.random()*5)];
    BOX.classList.toggle(color);
}