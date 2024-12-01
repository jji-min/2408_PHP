<?php

namespace App\Exceptions;

use Exception;

class MyAuthException extends Exception {
    /**
     * 에러 메세지 리스트
     */
    public function context() {
        return [
            'E20' => ['status'],
        ];
    }
}