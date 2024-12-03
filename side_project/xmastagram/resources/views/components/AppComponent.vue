<template>
    <header>
        <div class="header-container">
            <div class="header-content">
                <div class="title">
                    <a href=""><h1>X-Mastagram</h1></a>
                </div>
                <img src="/logo.png" class="img-logo">
                <div class="btn-group">
                    <div v-if="!$store.state.user.authFlg">
                        <router-link to="/login"><button class="btn btn-header btn-bg-black">로그인</button></router-link>
                        <router-link to="/registration"><button class="btn btn-header btn-bg-white">회원가입</button></router-link>
                    </div>
                    <div v-else>
                        <button @click="$store.dispatch('user/logout')" class="btn btn-header btn-bg-black">로그아웃</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <UserInfoComponent v-if="$store.state.user.authFlg" />
        <div class="container">
            <router-view></router-view>
        </div>
    </main>

    <footer>
        <p>ⓒHoHoHo~Merry~Christmas</p>
    </footer>
</template>
<script setup>

import UserInfoComponent from './user/UserInfoComponent.vue';

</script>
<style>
@import url('../../css/common.css'); 
</style>