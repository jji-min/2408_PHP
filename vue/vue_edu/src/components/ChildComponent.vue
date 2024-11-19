<template>
    <slot></slot>
    <h1>자식 컴포넌트</h1>
    <div v-for="item in props.data" :key="item">
        <!-- props의 data를 쓰겠다고 지정 -->
        <span>{{ item.name }}</span>
    </div>
    <p>{{ props.count }}</p>

</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    'data': Array
    // 키 : 데이터타입
    ,'count': Number
});
// 단방향 데이터 바인딩 되어서 부모쪽에서 바뀌면 자식 쪽에서도 바뀌어서 나타남
</script>

<style>    
</style>