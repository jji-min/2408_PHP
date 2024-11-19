<template>
    <div v-for="item in products" :key="item">
        <h2 @click="openDetailModal(item)">{{ item.productName }}</h2>
        <p>{{ item.productContent }}</p>
        <span>{{ item.productPrice }}원</span>
    </div>

    <!-- detail modal -->
    <Transition name="detailModalAnimation">
        <div class="bg-modal-black" v-show="flgDetail">
            <div class="bg-modal-white">
                <h1>{{ detailProduct.productName }}</h1>
                <p>{{ detailProduct.productContent }}</p>
                <p>{{ detailProduct.productPrice }}</p>
                <button @click="closeDetailModal">닫기</button>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { computed, ref } from 'vue';
import { useStore } from 'vuex';

const store = useStore();
const products = computed(() => store.state.board.products);

// 상세 모달 제어
const flgDetail = ref(false);
const detailProduct = computed(() => store.state.board.detailProduct);

const openDetailModal = (item) => {
    store.commit('board/setDetailProduct', item);
    flgDetail.value = true;
}

const closeDetailModal = () => {
    flgDetail.value = false;
}

</script>

<style>
    .bg-modal-black {
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.7);
        position: fixed;
        top: 0;
        left: 0;
    }
    .bg-modal-white {
        width: 80%;
        max-width: 300px;
        background-color: #fff;
        margin: 20px auto;
        padding: 20px;
    }

    /* enter - 없다가 등장할 때 효과 */
    .detailModalAnimation-enter-from {
        /* 트랜지션이름-enter-from(enter-from은 고정) */
        /* 이름을 이렇게 지어야 vue가 알아서 해당 트랜지션에 효과를 줌 */
        opacity: 0;
    }
    .detailModalAnimation-enter-active {
        transition: 1s ease;
    }
    .detailModalAnimation-enter-to {
        opacity: 1;
    }

    /* leave - 사라질 때 효과 */
    .detailModalAnimation-leave-from {
        /* transform: translateX(0px); */
        transform: rotate(0deg);
    }
    .detailModalAnimation-leave-active {
        transition: all 4s;
    }
    .detailModalAnimation-leave-to {
        /* transform: translateX(4000px); */
        transform: rotate(360deg) scale(0);
        border-radius: 50%;
    }
</style>