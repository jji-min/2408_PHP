<template>
    <!-- Header -->
    <header>
        <div class="header-container">
            <div class="header-content">
                <div class="title">
                    <router-link to="/board"><h1>멍stagram</h1></router-link>
                    <div>
                        <img src="/img/footprint.png" width="15px" style="margin-left: 10px;">
                        <img src="/img/footprint.png" width="20px">
                        <img src="/img/footprint.png" width="25px">
                    </div>
                </div>
                <img src="/mung.png" class="img-logo">
                <div class="btn-group">
                    <router-link to="/login"><button class="btn btn-header btn-bg-black">로그인</button></router-link>
                    <router-link to="/registration"><button class="btn btn-header btn-bg-white">회원가입</button></router-link>
                </div>
            </div>
        </div>
    </header>

    <!-- Main -->
    <main>
        <UserInfoComponent />
        <div class="container">
            <router-view></router-view>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>ⓒJeonsegye modeun gangagee</p>
    </footer>
    
</template>

<script setup>

import UserInfoComponent from './user/UserInfoComponent.vue';

</script>

<style>
@import url('../../css/common.css');
</style>