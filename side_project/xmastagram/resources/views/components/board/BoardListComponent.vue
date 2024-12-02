<template>
    <!-- 리스트 -->
    <div class="board-list-box">
        <div @click="openModal" class="item">
            <img src="img/xmas1.jpg">
        </div>
        <div @click="openModal" class="item">
            <img src="img/xmas2.jpg">
        </div>
        <div @click="openModal" class="item">
            <img src="img/xmas3.jpg">
        </div>
        <div @click="openModal" class="item">
            <img src="img/xmas4.jpg">
        </div>
    </div>

    <!-- 상세 모달 -->
    <div v-show="modalFlg" class="board-detail-box">
        <div class="item">
            <img src="img/santa.jpg">
            <hr>
            <p>HoHoHoHoHo</p>
            <hr>
            <div class="etc-box">
                <span>작성자 : 산타임</span>
                <button @click="closeModal" class="btn btn-bg-black">닫기</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

// -------------------
// 모달
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