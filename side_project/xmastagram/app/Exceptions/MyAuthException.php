<?php

namespace App\Exceptions;

use Exception;

class MyAuthException extends Exception {
    /**
     * 에러 메세지 리스트
     */
    public function context() {
        return [
            'E20' => ['status' => 401, 'msg' => '토큰이 없습니다.']
            ,'E21' => ['status' => 401, 'msg' => '만료된 토큰입니다.']
            ,'E22' => ['status' => 401, 'msg' => '위조된 토큰입니다.']
            ,'E23' => ['status' => 401, 'msg' => '양식에 맞지 않는 토큰입니다.']
            ,'E24' => ['status' => 401, 'msg' => '토큰 정보에 이상이 있습니다.']
        ];
    }
}