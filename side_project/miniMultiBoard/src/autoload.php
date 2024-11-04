<?php

// 인스턴스화되면 자동으로 autoload 먼저 실행됨
// path에 Route\Route()가 옴
spl_autoload_register(function($path) {
    require_once(str_replace('\\', '/', $path).'.php'); // '\'는 두개 적어야 인식함
    // Route/Route()가 됨
});