<template>
    <div class="form-box">
        <h3 class="form-title">회원가입</h3>
        <input type="text" name="account" placeholder="아이디" autocomplete="off">
        <input type="password" name="password" placeholder="비밀번호" autocomplete="off">
        <input type="password" name="password_chk" placeholder="비밀번호 확인" autocomplete="off">
        <input type="text" name="name" placeholder="이름" autocomplete="off">
        <div class="radio-box">
            <div>
                <label for="male">남자</label>
                <input type="radio" name="gender" id="male" value="0">
            </div>
            <div>
                <label for="female">여자</label>
                <input type="radio" name="gender" id="female" value="1">
            </div>
        </div>
        <input type="file" name="profile" accept="image/*">
        <hr>
        <button class="btn btn-sumbmit btn-bg-black">회원가입</button>
        <button @click="$router.replace('/login')" class="btn btn-sumbmit">취소</button>
    </div>
</template>

<script setup>
</script>

<style>    
</style>