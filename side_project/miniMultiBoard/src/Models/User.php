<?php

namespace Models;

use Models\Model;
use Throwable;

class User extends Model {
    public function getUserInfo($paramArr) {
        try {
            $sql =
                ' SELECT * '
                .' FROM users '
                .' WHERE u_email = :u_email '
            ;

            $stmt = $this->conn->prepare($sql); // conn은 부모 Model에 있음
            $stmt->execute($paramArr);
            return $stmt->fetch();
        } catch(Throwable $th) {
            echo 'User->getUserInfo(), '.$th->getMessage();
            exit;
        }
    }
}