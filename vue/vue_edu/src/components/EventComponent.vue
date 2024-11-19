<template>
    <p>자식쪽 cnt : {{ props.cnt }}</p>
    <button @click="$emit('eventAddCnt')">자식쪽증가</button>
    
    <!-- 파라미터가 필요한 경우 -->
    <button @click="$emit('eventAddCntParam', 3)">자식쪽에서 증가2</button>
    
    <button @click="$emit('eventReset')">자식쪽 초기화</button>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    'cnt': Number
});
</script>

<style>
</style>