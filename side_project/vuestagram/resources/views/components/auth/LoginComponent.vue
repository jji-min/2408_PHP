<template>
    <div class="form-box">
        <p class="form-title">로그인</p>
        <input v-model="userInfo.account" type="text" name="account" placeholder="아이디">
        <input v-model="userInfo.password" type="password" name="password" placeholder="비밀번호">
        <button @click="$store.dispatch('user/login', userInfo)" class="btn btn-submit btn-bg-black">로그인</button>
        <!-- template에서만 $store로 접근가능 -->
        <!-- user.js의 actions의 login -->
    </div>
</template>

<script setup>
import { reactive } from 'vue';

// store를 여러 처리를 해야하면 script에서, 아니면 template에서 호출

const userInfo = reactive({
    account: '',
    password: '',
});
</script>

<style>
    
</style>