<template>
    <!-- 리스트 -->
    <div class="board-list-box">
        <div @click="openModal" class="item">
            <img src="/img/mang1.png" alt="">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/mang2.png" alt="">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/mang3.png" alt="">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/mang4.png" alt="">
        </div>
    </div>
    
    <!-- 상세 모달 -->
    <div v-show="modalFlg" class="board-detail-box">
        <div class="item">
            <img src="/img/mang1.png">
            <hr>
            <p>내용내용</p>
            <hr>
            <div class="etc-box">
                <span>작성자 : 김아무개</span>
                <button @click="closeModal">닫기</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

// -----------------------------------
// 모달 관련
const modalFlg = ref(false);
const openModal = () => {
    modalFlg.value = true;
}
const closeModal = () => {
    modalFlg.value = false;
}
// -----------------------------------

</script>

<style>
@import url('../../../css/boardList.css');
</style>