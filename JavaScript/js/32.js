// ---------------------
// String 객체 - 문자열
// ---------------------
// let str = '문자열입니다.';
let str = '문자열입니다.문자열입니다.';
let str2 = new String('문자열입니다.');

// length : 문자열의 길이를 반환
// length는 프로퍼티
// iterable한 객체는 length가 있음
console.log(str.length);

// charAt(idx) : 해당 인덱스의 문자를 반환
console.log(str.charAt(2)); // 열 출력, 벗어난 인덱스나 음수를 넣으면 빈문자열
// str.charAt() -> 괄호안에 아무것도 안적으면 첫번째 값이 나옴

// indexOf() : 문자열에서 해당 문자열을 찾아 최초의 인덱스를 반환
// 해당 문자열이 없으면 -1 리턴
console.log(str.indexOf('자열')); // 1, 반복되더라도 최초의 인덱스 반환
console.log(str.indexOf('자열', 5)); // 8, 5번 위치부터 찾기 시작

// includes() : 문자열에서 해당 문자열의 존재여부 체크
console.log(str.includes('문자')); // true
console.log(str.includes('php')); // false

let test = 'i am ironman';
test.includes('ir'); // true
// 공백도 하나의 문자로 인식

// replace() : 특정 문자열을 찾아서 지정한 문자열로 치환한 문자열을 반환
str = '문자열입니다.문자열입니다.';
console.log(str.replace('문자열', 'PHP')); // PHP입니다.문자열입니다.
// 원본은 바뀌지 않음. 첫번째로 찾은 문자열만 치환함
// 찾는 문자열이 없으면 원본이 출력됨

// replaceAll() : 특정 문자열을 찾아서 모두 지정한 문자열로 치환한 문자열을 반환
console.log(str.replaceAll('문자열', 'PHP')); // PHP입니다.PHP입니다.
console.log(str.replaceAll('문자열', '')); // 해당 문자열을 지울 수 있음

// substring(start, end) : 시작 인덱스부터 종료 인덱스까지 자른 문자열을 반환
// endIndex는 생략시 startIndex부터 끝까지의 문자열 반환
// ** 주의 : 비슷한 기능으로 String.substr()이 있으나 비표준이므로 사용을 지양할 것 **
str = '문자열입니다.문자열입니다.';
console.log(str.substring(1, 3)); // 자열

str = 'bearer: 34kdsjafakjsalkjfklsaj';
console.log(str.substring(8)); // end를 안적으면 끝까지로 인식

// split(separator, limit) : 문자열을 separator 기준으로 잘라서 배열을 만들어 반환
// limit 생략가능
// php의 explode와 같은 기능
// limit은 배열의 길이 제한, 잘 사용하지 않음
str = '짜장면,탕수육,라조기,짬뽕,볶음밥';
let arrSplit = str.split(',');
let arrSplit2 = str.split(',', 2); // ['짜장면', '탕수육'], 배열의 길이를 2로 제한
console.log(arrSplit);
console.log(arrSplit2);

// trim() : 좌우 공백 제거해서 반환
// 현업에서는 user에게서 전달받은 값을 사용할 때 trim을 많이 사용함
str = '   아아아아아아아 배고파아아아아   ';
console.log(str.trim());

// toUpperCase(), toLowerCase() : 알파벳을 대/소문자로 변환해서 반환
str = 'aBcDeFg';
console.log(str.toUpperCase()); // ABCDEFG
console.log(str.toLowerCase()); // abcdefg


// const str1 = new String('abc'); // str1 === str2 -> false
// const str2 = new String('abc');

// const str3 = 'abc'; // str3 === str4 -> true
// const str4 = 'abc';