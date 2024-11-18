<template>
    <!-- <h1 @click="cnt++">{{ cnt }}</h1> -->
    <!-- 인라인 핸들러 -->
    <h1 @click="addCnt">{{ cnt }}</h1>
    <!-- 메소드 핸들러 -->
    <hr>
    <input type="text" v-model="tel">
    <span :style="color">{{ msg }}</span>
</template>

<script setup>
import { ref, watch } from 'vue';

// Watchers : 감시자
// 실시간 validation 검사 가능
// tel이 변화했을 때 감시
const tel = ref('');
const msg = ref('X');
const color = ref('color: red;');

watch(tel, (val) => {
    const regex = /^[0-9]{10,11}$/;
    if(!regex.test(val)) { // 맞으면 true, 틀리면 false
        msg.value = 'X';
        color.value = 'color: red;';
    } else {
        msg.value = 'O';
        color.value = 'color: green;';
    }
});
// tel은 ref 객체
// val은 tel의 value를 가져옴

// ---------------------
const cnt = ref(0);
// function addCnt() {
//     cnt.value++;
// }

const addCnt = () => {
    cnt.value++;
}
</script>
<style>
    
</style>