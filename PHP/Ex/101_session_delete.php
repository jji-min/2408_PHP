<?php

// 세션 시작 : 세션 시작 전에 출력처리(echo, vardump 등)가 있으면 안된다.
session_start();

session_destroy(); // 세션 파기
// 쿠키에는 ID가 남아있음(쿠키 삭제를 안했기 때문) -> 상관없음
// 이름이 같기 때문에 쿠키에 ID가 쌓이진 않음