<template>
    <div class="form-box">
        <h3 class="form-title">글 작성</h3>
        <img src="">
        <textarea name="content" placeholder="내용을 적어주세요." maxlength="200"></textarea>
        <input type="file" name="file" accept="image/*">
        <button class="btn btn-bg-black btn-submit">작성</button>
        <button @click="$router.back()" class="btn btn-submit">취소</button>
    </div>
</template>

<script setup>
</script>

<style>
    
</style>