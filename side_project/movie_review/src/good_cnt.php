<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
    require_once(MY_PATH_DB_LIB);

    $conn = null;

    try {
        $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;  // id 획득

        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;  // page 획득

        if($id < 1) {
            throw new Exception("파라미터 오류");
        }

        $conn = my_db_conn();

        $arr_prepare = [
            "id" => $id
        ];
        $result = my_reviews_select_id($conn, $arr_prepare);  // id 이용해서 데이터 조회

        $conn->beginTransaction();

        $good = $result["good"] + 1;
        $arr_preapre_good = [
            "id" => $id
            ,"good" => $good
        ];
        my_reviews_update_good($conn, $arr_preapre_good);
        $conn->commit();
        header("Location: /detail.php?id=".$id."&page=".$page);
        exit;
    } catch(Throwable $th) {
        if(!is_null($conn) && $conn->inTransaction()) {
            $conn->rollBack();
        }

        require_once(MY_PATH_ERROR);
        exit;
    }
?>