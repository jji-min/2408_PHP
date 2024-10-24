// if문
let num = 1;

if(num === 1) {
    console.log('1등');
} else if(num === 2) {
    console.log('2등');
} else if(num === 3) {
    console.log('3등');
} else {
    console.log('등수외');
}

// switch문
switch(num) {
    case 1:
        console.log('1등');
        break;
    case 2:
        console.log('2등');
        break;
    default:
        console.log('순위외');
        break;
}

// for문
for(let i = 0; i < 3; i++) {
    console.log(i);
}

// 구구단 2~9단
for(let i = 2; i <= 9; i++) {
    console.log('** ' + i + '단 **');
    for(let z = 1; z <= 9; z++) {
        console.log(i + ' X ' + z + ' = ' + (i * z));
    }
}

for(let dan = 2; dan <= 9; dan++) {
    console.log(dan + '단');
    for(let gu = 1; gu <= 9; gu++) {
        console.log(dan + ' X ' + gu + ' = ' + (dan * gu));
    }
}

// 별 찍기
let star = "";
for(let i = 1; i <= 5; i++) {
    for(let z = 5 - i; z > 0; z--) {
        star += " ";
    }
    for(let r = 1; r <= i; r++) {
        star += "*";
    }
    star += '\n';
}
console.log(star);

let str = "";
for(let i = 0; i < 5; i++) {
    for(let z = 5; z > 0; z--) {
        if(z - i > 1) {
            str += " ";
        } else {
            str += "*";
        }
    }
    str += '\n';
}
console.log(str);

// for...in : 모든 객체를 반복하는 문법, key에 접근
const OBJ2 = {
    key1: '입'
    ,key2: '털'
    ,key3: '어'
    ,key4: '블'
}

for(let key in OBJ2) {
    console.log(OBJ2[key]);
}
// key에 key1이 들어가서 val1이 찍히고, key2가 들어가서 val2가 찍힘

// for...of : 이터러블(iterable-순서가 정해져있는 객체) 객체를 반복하는 문법, value에 접근
const STR1 = '안녕하세요'; // 문자 하나하나가 연결되어있음, string은 iterable 객체 중 하나

for(let val of STR1) {
    console.log(val);
}

const ARR1 = [1, 2, 3];
// JavaScript에서 length속성이 있는 객체는 iterable 객체
// length찍었을 때 undefined나오면 iterable 객체 아님
