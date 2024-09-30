<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");

function my_db_conn() {
    $option = [
        PDO::ATTR_EMULATE_PREPARES      => false
        ,PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
        ,PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC
    ];

    return new PDO(MY_MARIADB_DSN, MY_MARIADB_USER, MY_MARIADB_PASSWORD, $option);
}

/**
 * reviews select 페이지네이션
 */
function my_reviews_select_pagination(PDO $conn, array $arr_param) {
    // SQL
    $sql = 
        " SELECT "
        ."      * "
        ." FROM "
        ."      reviews "
        ." WHERE "
        ."      deleted_at IS NULL "
        ." ORDER BY "
        ."      created_at DESC "
        ."      ,id DESC "
        ." LIMIT :list_cnt OFFSET :offset "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);
    
    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }

   return $stmt->fetchAll();
}