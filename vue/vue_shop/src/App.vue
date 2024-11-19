<template>
  <img alt="Vue logo" src="./assets/logo.png">
  <!-- <h1>{{ count }}</h1>
  <button @click="store.commit('board/addCount')">증가</button> -->
  <!-- commit('모듈명'/호출할 메소드명) -> mutation에 있는것만 가능 -->
  
  <BoardListComponent />

</template>

<script setup>
import BoardListComponent from './components/BoardListComponent.vue';

// import { computed } from 'vue';
// import { useStore } from 'vuex';

// const store = useStore(); // store와 board가 합쳐져서 두개의 정보가 담겨있음

// 반응형 데이터로 다루기 위해 computed 이용
// 양방향 데이터 바인딩
// const count = computed(() => store.state.board.count); // store의 state영역 board 모듈의 count(count는 프로퍼티)
// store를 만들면 state, mutations, actions등이 만들어지고, 각 영역에 모듈이 들어가 있음

// const products = computed(() => store.state.board.products);

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
</style>
