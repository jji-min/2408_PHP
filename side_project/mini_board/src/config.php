<?php

// ** MariaDB 설정 **
define("MY_MARIADB_HOST", "localhost");
define("MY_MARIADB_PORT", "3306");
define("MY_MARIADB_USER", "root");
define("MY_MARIADB_PASSWORD", "php504");
define("MY_MARIADB_NAME", "mini_board");
define("MY_MARIADB_CHARSET", "utf8mb4");
define("MY_MARIADB_DSN", "mysql:host=".MY_MARIADB_HOST.";port=".MY_MARIADB_PORT.";dbname=".MY_MARIADB_NAME.";charset=".MY_MARIADB_CHARSET);

// ** PHP Path 관련 설정 **
define("MY_PATH_ROOT", $_SERVER["DOCUMENT_ROOT"]);  // 웹서버 document root
// 다른것과 연결해주기 위해 '/' 추가, 추가하지 않으면 다른곳에 연결할 때 폴더명이 바뀔 수 있음
define("MY_PATH_DB_LIB", MY_PATH_ROOT."/lib/db_lib.php");  // DB 라이브러리 path
define("MY_PATH_ERROR", MY_PATH_ROOT."/error.php");  // 에러 페이지
define("MY_PATH_HEADER", MY_PATH_ROOT."/header.php");  // 헤더

// ** 로직 관련 설정 **
define("MY_LIST_COUNT", 3);
define("MY_PAGE_BUTTON_COUNT", 5);