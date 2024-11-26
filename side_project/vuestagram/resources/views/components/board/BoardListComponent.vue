<template>
    <!-- 리스트 -->
    <div class="board-list-box">
        <div v-for="item in boardList" :key="item" @click="openModal" class="item">
            <img :src="item.img">
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
import { computed, onBeforeMount, ref } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

const boardList = computed(() => store.state.board.boardList);

// 비포 마운트 처리
onBeforeMount(() => {
    if(store.state.board.boardList.length < 1) {
        store.dispatch('board/getBoardListPagination');
    }
});



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