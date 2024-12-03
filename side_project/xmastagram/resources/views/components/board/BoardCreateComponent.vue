<template>
    <div class="form-box">
        <h3 class="form-title">글 작성</h3>
        <img :src="preview">
        <textarea v-model="boardInfo.content" name="content" placeholder="내용을 적어주세요." maxlength="200"></textarea>
        <input @change="setFile" type="file" name="file" accept="image/*">
        <button @click="$store.dispatch('board/storeBoard', boardInfo)" class="btn btn-submit btn-bg-black">작성</button>
        <button @click="$router.push('/boards')" class="btn btn-submit">취소</button>
    </div>
</template>

<script setup>
import { reactive, ref } from 'vue';

const boardInfo = reactive({
    content: ''
    ,img: null
});
const preview = ref('');

const setFile = (e) => {
    boardInfo.file = e.target.files[0];
    preview.value = URL.createObjectURL(boardInfo.file);
}
</script>

<style>    
</style>