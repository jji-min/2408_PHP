<?php
// 부모
namespace Controllers;

class Controller {

    public function __construct(string $action) {
        // 세션 시작

        // 유저 로그인 및 권한체크

        // 해당 Action 호출 - Action은 해당 controller의 메소드
        $resultAction = $this->$action();
        // echo $resultAction;

        // view 호출
        $this->callView($resultAction);

        exit; // php 처리 종료
    }

    /**
     * 뷰 OR 로케이션 처리용 메소드
     */
    private function callView($path) {
        if(strpos($path, 'Location:') === 0) { // 찾고자하는 문자열의 위치 찾는 함수
            header($path);
        } else {
            require_once(_PATH_VIEW.'/'.$path);
        }
    }
}