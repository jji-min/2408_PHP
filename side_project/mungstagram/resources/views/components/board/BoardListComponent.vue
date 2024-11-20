<template>
    <div class="board-list-box">
        <div @click="openModal" class="item">
            <img src="/img/mung1.jfif" alt="">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/mung2.jpg" alt="">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/mung3.jpg" alt="">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/mung4.jfif" alt="">
        </div>
    </div>

    <!-- 상세 모달 -->
    <div v-show="modalFlg" class="board-detail-box">
        <div class="item">
            <img src="/img/mung1.jfif">
            <hr>
            <p>mungmung</p>
            <hr>
            <div class="etc-box">
                <span>작성자 : 김멍뭉</span>
                <button @click="closeModal">닫기</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const modalFlg = ref(false);
const openModal = () => {
    modalFlg.value = true;
}
const closeModal = () => {
    modalFlg.value = false;
}
</script>

<style>
@import url('../../../css/boardList.css');
</style>