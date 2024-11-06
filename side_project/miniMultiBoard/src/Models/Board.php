<?php

namespace Models;

use Models\Model;
use Throwable;

class Board extends Model {
    public function getBoardList($paramArr) {
        try {
            $sql = 
                ' SELECT * '
                .' FROM boards'
                .' WHERE '
                .'      bc_type = :bc_type '
                .' AND deleted_at IS NULL '
                .' ORDER BY '
                .'      created_at DESC, b_id DESC '
            ;

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($paramArr);
            return $stmt->fetchAll();
        } catch(Throwable $th) {
            echo 'Board->getBoardList(), '.$th->getMessage();
            exit;
        }
    }

    // public function getBoardDetail($paramArr) {
    //     try {
    //         $sql = 
    //             ' SELECT * '
    //             .' FROM boards '
    //             .' WHERE '
    //             .'      b_id = :b_id '
    //             .' AND deleted_at IS NULL '
    //         ;

    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute($paramArr);
    //         return $stmt->fetch();
    //     } catch(Throwable $th) {
    //         echo 'Board->getBoardDetail(), '.$th->getMessage();
    //         exit;
    //     }
    // }

    public function getBoardDetail($paramArr) {
        try {
            $sql = 
                ' SELECT '
                .'      users.u_name '
                .'      ,boards.b_title '
                .'      ,boards.b_content '
                .'      ,boards.b_img '
                .'      ,boards.b_id '
                .' FROM boards '
                .'      JOIN users '
                .'          ON users.u_id = boards.u_id '
                .' WHERE '
                .'      boards.b_id = :b_id '
                .' AND boards.deleted_at IS NULL '
            ;
            // join할 때 가져올 컬럼을 명확히 기재해야함

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($paramArr);
            return $stmt->fetch();
        } catch(Throwable $th) {
            echo 'Board->getBoardDetail(), '.$th->getMessage();
            exit;
        }
    }
}