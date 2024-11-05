<?php

// 세션 시작 : 세션 시작 전에 출력처리(echo, vardump 등)가 있으면 안된다.
// 모든 처리의 최초에 진행함
session_start();
// 새로운 세션ID를 만들어서 저장함
// 쿠키에 세션ID를 저장함 -> 유저가 이전에 들어왔던 유저인지 파악할 수 있음

$_SESSION['test_session'] = '세션';