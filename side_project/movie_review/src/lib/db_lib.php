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

/**
 * reviews 테이블 유효 게시글 총 수 획득
 */
function my_reviews_total_count(PDO $conn) {
    $sql =
        " SELECT "
        ."      count(*) cnt "
        ." FROM "
        ."      reviews "
        ." WHERE "
        ."      deleted_at IS NULL "
    ;
    
    $stmt = $conn->query($sql);
    $result = $stmt->fetch();

    return $result["cnt"];
}

/**
 * board 테이블 insert 처리
 */
function my_reviews_insert(PDO $conn, array $arr_param) {
    $sql =
        " INSERT INTO reviews ( "
        ."      title "
        ."      ,rating "
        ."      ,review "
        ."      ,img "
        ." ) "
        ." VALUES ( "
        ."      :title "
        ."      ,:rating "
        ."      ,:review "
        ."      ,:img "
        ." ) "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }

    $result_cnt = $stmt->rowCount();

    if($result_cnt !== 1) {
        throw new Exception("Insert Count 이상");
    }

    return true;
}

/**
 * id로 게시글 조회
 */
function my_reviews_select_id(PDO $conn, array $arr_param) {
    $sql =
        " SELECT "
        ."      * "
        ." FROM "
        ."      reviews "
        ." WHERE "
        ."      id = :id "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }

    return $stmt->fetch();
}

/**
 * 게시글 좋아요 수 관리
 */
function my_reviews_update_good(PDO $conn, array $arr_param) {
    $sql =
        " UPDATE reviews "
        ." SET "
        ."      good = :good "
        ." WHERE "
        ."      id = :id "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }

    if($stmt->rowCount() !== 1) {
        throw new Exception("Update Count 이상");
    }

    return true;
}

/**
 * 게시글 싫어요 수 관리
 */
function my_reviews_update_bad(PDO $conn, array $arr_param) {
    $sql =
        " UPDATE reviews "
        ." SET "
        ."      bad = :bad "
        ." WHERE "
        ."      id = :id "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }

    if($stmt->rowCount() !== 1) {
        throw new Exception("Update Count 이상");
    }

    return true;
}

/**
 * reviews 테이블 update - 이미지 있을 때
 */
function my_reviews_update_id(PDO $conn, array $arr_param) {
    $sql = 
        " UPDATE reviews "
        ." SET "
        ."      title = :title "
        ."      ,rating = :rating "
        ."      ,review = :review "
        ."      ,img = :img "
        ."      ,updated_at = NOW() "
        ."  WHERE "
        ."      id = :id "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }

    if($stmt->rowCount() !== 1) {
        throw new Exception("Update Count 이상");
    }

    return true;
}

/**
 * reviews 테이블 update - 이미지 없을 때
 */
function my_reviews_noimg_update_id(PDO $conn, array $arr_param) {
    $sql = 
        " UPDATE reviews "
        ." SET "
        ."      title = :title "
        ."      ,rating = :rating "
        ."      ,review = :review "
        ."      ,updated_at = NOW() "
        ."  WHERE "
        ."      id = :id "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);

    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }

    if($stmt->rowCount() !== 1) {
        throw new Exception("Update Count 이상");
    }

    return true;
}

/**
 * reviews 테이블 delete
 */
function my_reviews_delete_id(PDO $conn, array $arr_param) {
    $sql =
        " UPDATE reviews "
        ." SET "
        ."      updated_at = NOW() "
        ."      ,deleted_at = NOW() "
        ." WHERE "
        ."      id = :id "
    ;

    $stmt = $conn->prepare($sql);
    $result_flg = $stmt->execute($arr_param);
    
    if(!$result_flg) {
        throw new Exception("쿼리 실행 실패");
    }

    if($stmt->rowCount() !== 1) {
        throw new Exception("Update Count 이상");
    }

    return true;
}