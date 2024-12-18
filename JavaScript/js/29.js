// ----------------
// Math 객체
// ----------------
// 올림, 버림, 반올림
Math.ceil(0.1); // 1, number타입으로 리턴
Math.round(0.5); // 1
Math.floor(0.9); // 0

// 랜덤값
Math.random(); // 0 ~ 1사이의 랜덤한 값을 획득, 0이상 1미만
Math.floor(Math.random() * 10) + 1; // 1~10 랜덤 숫자
// 현업에서 random을 사용할 때는 random만 사용하지 않고 여러가지 연산을 활용하여 가공하여 사용함

// 최대값
Math.max(1, 2, 3, 4); // 4
let arr = [1, 2, 3, 4, 5];
Math.max(...arr); // 5
// 그냥 arr만 보내면 객체라서 값 비교가 안됨 에러남
// ... -> 배열의 값들만 들고온다는 의미

// 최소값
Math.min(3, 5, 2, 1, 0); // 0
Math.min(...arr); // 1

// 절대값
// 돈 관련 계산할 때 사용함
Math.abs(-1); // 1
Math.abs(1); // 1