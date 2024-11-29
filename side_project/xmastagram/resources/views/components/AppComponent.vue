<template>
    <header>
        <div class="header-container">
            <div class="header-content">
                <div class="title">
                    <a href=""><h1>X-Mastagram</h1></a>
                </div>
                <img src="/logo.png" class="img-logo">
                <div class="btn-group">
                    <button class="btn btn-header btn-bg-black">로그인</button>
                    <button class="btn btn-header btn-bg-white">회원가입</button>
                </div>
            </div>
        </div>
    </header>

    <main>
        <UserInfoComponent />
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