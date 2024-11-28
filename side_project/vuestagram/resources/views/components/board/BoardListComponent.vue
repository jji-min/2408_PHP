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
                <button @click="closeModal" class="btn btn-bg-black">닫기</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onBeforeMount, ref } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

// 보드 상세 정보
const boardDetail = computed(() => store.state.board.boardDetail);

// 보드리스트
const boardList = computed(() => store.state.board.boardList);

// 비포 마운트 처리
onBeforeMount(() => {
    if(store.state.board.boardList.length < 1) {
        store.dispatch('board/boardListPagination');
    }
});

// -----------------------------------
// 스크롤 이벤트 관련
const boardScrollEvent = () => {
    if(store.state.board.controllFlg) {
        const docHeight = document.documentElement.scrollHeight; // 문서 기준 Y축 길이
        const winHeight = window.innerHeight; // 윈도우의 Y축 총 길이
        const nowHeight = window.scrollY; // 현재 스크롤 위치
        const viewHeight = docHeight - winHeight; // 끝까지 스크롤 했을 때 Y축 위치
        
        // console.log(viewHeight, nowHeight);
        if(viewHeight <= nowHeight) {
            store.dispatch('board/boardListPagination');
        }

        // setTimeout(() => {
        //     store.commit('board/setControllFlg', true)
        // }, 2000);
        // 쓰로틀링 -> setTimeout이용
    }
    
    
}

window.addEventListener('scroll', boardScrollEvent);



// -----------------------------------

// -----------------------------------
// 모달 관련
const modalFlg = ref(false);
const openModal = (id) => {
    store.dispatch('board/showBoard', id);
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