<template>
    <!-- 리스트 -->
    <div class="board-list-box">
        <div v-for="item in boardList" :key="item" @click="openModal(item.board_id)" class="item">
            <img :src="item.img">
        </div>
    </div>

    <!-- 상세 모달 -->
    <div v-show="modalFlg" class="board-detail-box">
        <div v-if="boardDetail" class="item">
            <img :src="boardDetail.img">
            <hr>
            <p>{{ boardDetail.content }}</p>
            <hr>
            <div class="etc-box">
                <span>작성자 : {{ boardDetail.user.name }}</span>
                <div class="btn-group">
                    <button @click="destroy(boardDetail.board_id)" class="btn btn-header btn-bg-black">삭제</button>
                    <button @click="closeModal" class="btn btn-header btn-bg-white">닫기</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onBeforeMount, ref } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

// 보드 리스트
const boardList = computed(() => store.state.board.boardList);

// 보드 상세 정보
const boardDetail = computed(() => store.state.board.boardDetail);

onBeforeMount(() => {
    if(store.state.board.boardList.length < 1) {
        store.dispatch('board/boardListPagination');
    }
});

// -------------------
// 스크롤 이벤트 관련
const boardScrollEvent = () => {
    if(store.state.board.controllFlg) {
        const docHeight = document.documentElement.scrollHeight;
        const winHeight = window.innerHeight;
        const nowHeight = window.scrollY;
        const viewHeight = docHeight - winHeight;

        if(viewHeight <= nowHeight) {
            store.dispatch('board/boardListPagination');
        }
    }
}
window.addEventListener('scroll', boardScrollEvent);

// -------------------
// 모달
const modalFlg = ref(false);
const openModal = (id) => {
    store.dispatch('board/showBoard', id);
    modalFlg.value = true;
}
const closeModal = () => {
    modalFlg.value = false;
}

// --------------------
// 삭제
const destroy = (id) => {
    store.dispatch('board/destroyBoard', id);
}
</script>

<style>
@import url('../../../css/boardList.css');
</style>