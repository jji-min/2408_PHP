// ------------------
// 배열
// ------------------
// PHP는 타입상관없이 다 들어감, 키 사이에 순서가 없음
// 다른 언어들은 데이터의 순서가 정해져 있음
const ARR1 = [1, 2, 3, 4, 5]; // ARR1[2]로 접근 가능

// push()
// 원본 배열의 마지막 요소를 추가, 리턴은 변경된 length
ARR1.push(10); // '.'으로 접근, 무조껀 마지막에 추가됨
// ARR1의 부모는 Array -> 부모가 가진 요소 사용 가능

// length
// 배열의 길이 획득
console.log(ARR1.length); // 메소드가 아닌 프로퍼티여서 () 필요없음

// isArray()
// 배열인지 아닌지 체크
console.log(Array.isArray(ARR1)); // true 출력
console.log(Array.isArray(1)); // false 출력