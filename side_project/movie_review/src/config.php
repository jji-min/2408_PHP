<?php

// MariaDB 설정
define("MY_MARIADB_HOST", "localhost");
define("MY_MARIADB_PORT", "3306");
define("MY_MARIADB_USER", "root");
define("MY_MARIADB_PASSWORD", "php504");
define("MY_MARIADB_NAME", "movie_review");
define("MY_MARIADB_CHARSET", "utf8mb4");
define("MY_MARIADB_DSN", "mysql:host=".MY_MARIADB_HOST.";port=".MY_MARIADB_PORT.";dbname=".MY_MARIADB_NAME.";charset=".MY_MARIADB_CHARSET);

// PHP Path 관련 설정
define("MY_PATH_ROOT", $_SERVER["DOCUMENT_ROOT"]."/");  // 웹서버 document root
define("MY_PATH_DB_LIB", MY_PATH_ROOT."lib/db_lib.php");  // DB 라이브러리 path
define("MY_PATH_ERROR", MY_PATH_ROOT."error.php");  // error path
define("MY_PATH_HEADER", MY_PATH_ROOT."header.php");  // header path
define("MY_PATH_PRINT_STARS", MY_PATH_ROOT."print_star.php");  // print_star path

// 로직 관련 설정
define("MY_LIST_COUNT", 3);  // limit 설정
define("MY_PAGE_BUTTON_COUNT", 3);  // 페이지 버튼 수 설정