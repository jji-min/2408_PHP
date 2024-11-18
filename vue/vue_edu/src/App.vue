<template>
  <!-- 자식 컴포넌트 호출 -->
  <BoardComponent />

  <hr>
  <!-- 리스트 랜더링 -->
  <!-- v-for -->
  <!-- 단순 반복 -->
  <div v-for="val in 5" :key="val">
    <p>{{ val }}</p>
  </div>
  <!-- 뷰가 반복문 돌면서 내부적으로 사용하도록 세팅, 무조껀 해야함, 뷰가 사용하는 고유한 식별자 -->
  <!-- 숫자만 넣으면 무조껀 1부터 돌아감 -->
  
  <!-- 구구단 -->
  <!-- <div v-for="val in 8" :key="val">
    <p>{{ val + 1 }}단</p>
    <div v-for="val2 in 9" :key="val2">
      <p>{{ val + 1 }} X {{ val2 }} = {{ (val + 1) * val2 }}</p>
    </div>
  </div>

  <div v-for="dan in 9" :key="dan">
    <span>{{ `${dan} 단` }}</span>
    <div v-for="val in 9" :key="val">
      <span>{{ `${dan} * ${val} = ${(dan * val)}` }}</span>
    </div>
  </div> -->

  <div v-for="(item, key) in data" :key="item"> <!-- (값, 키), 0번부터 시작 -->
    <p>{{ `${key}번째 ${item.name} - ${item.age} - ${item.gender}` }}</p>
  </div>
  <!-- <button @click="data.pop">둘리삭제</button> -->

  <!-- <div v-if="true">
    <div v-if="true"></div>
  </div>
  <div v-else="true"></div>

  if() {
    if() {

    }
  } else {

  } -->

  <!-- 조건부 랜더링 -->
  <!-- v-if -->
  <!-- &&나 || 가능 -->
  <!-- 요소 자체를 지우고 다시 생성 -->
  <h1 v-if="cnt === 7">럭키비키자나🍀</h1>
  <h1 v-else-if="cnt >= 5">5이상입니다.</h1>
  <h1 v-else-if="cnt < 0">음수입니다.</h1>
  <h1 v-else>숫자입니다.</h1>
  <!-- 중간에 다른 태그가 들어가면 에러남 -->

  <!-- v-show -->
  <!-- 요소 자체는 그대로 두고 화면상에서만 보이고 안보이고 -->
  <!-- 보였다 안보였다 토글은 v-show로 만드는 것이 더 경제적 -->
  <h1 v-show="flgShow">브이 쇼</h1>
  <button @click="flgShow = !flgShow">브이쇼 토글</button>
  <h1>{{ cnt }}</h1>
  <button @click="addCnt">+</button>
  <button @click="disCnt">-</button>
  <!-- 자동으로 value에 있는 값을 가져오기 때문에 그냥 cnt++해도 작동했던 것 -->
  <hr>
  <h2>이름 : {{ userInfo.name }}</h2>
  <h2 :class="ageBlue">나이 : {{ userInfo.age }}</h2>
  <!-- 뷰에서 해당 클래스에 데이터 바인딩하기 위해 :class -->
  <h2>성별 : {{ userInfo.gender }}</h2>
  <button @click="changeName">이름 변경</button>
  <button @click="changeAgeBlue">나이 파란색으로</button>
  <!-- 모듈화했기 때문에 함수를 여러개 호출하는 경우는 없음 -->
  <hr>
  <input type="text" v-model="transgender">
  <button @click="userInfo.gender = transgender">성별 변경</button>
  <p>{{ transgender }}</p>
  <hr>
</template>

<script setup>
import BoardComponent from './components/BoardComponent.vue';
import { reactive, ref } from 'vue';

const data = reactive([
    {name: '홍길동', age: 20, gender: '남자'}
    ,{name: '김영희', age: 12, gender: '여자'}
    ,{name: '둘리', age: 41, gender: '수컷'}
]);

// -------------------

const flgShow = ref(true);

const transgender = ref('');

// -------------------

// (() => {
//   setInterval(() => {
//     flgShow.value = !flgShow.value
//   }, 500);
// })();

const ageBlue = ref('');

function changeAgeBlue() {
  ageBlue.value = 'blue';
}

// ----- ref -----
const cnt = ref(0);
// 객체
// 데이터 바인딩하는 것은 객체임
// 데이터 바인딩한 것은 안 쓰면 에러남
// const name = ref('홍길동');

function addCnt() {
  cnt.value++;
  // 접근하려면 value를 적어줘야함 -> 객체이기 때문
}

function disCnt() {
  cnt.value--;
}

// ----- reactive -----
const userInfo = reactive({
  name: '홍길동'
  ,age: 20
  ,gender: 'undefined'
});
// 객체
// .value가 존재하지 않음

function changeName() {
  userInfo.name = '갑순이'
}

</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.blue {
  color: #0000ff;
}
</style>
