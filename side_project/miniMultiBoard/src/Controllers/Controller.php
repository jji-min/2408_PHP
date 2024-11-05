<?php
// 부모
namespace Controllers;

use Models\BoardsCategory;

class Controller {
    protected $arrErrorMsg = []; // 화면에 표시할 에러 메시지 리스트
    protected $arrBoardNameInfo = []; // 헤더 게시판 드롭다운 리스트

    // 생성자
    public function __construct(string $action) {
        // 세션 시작
        if(session_status() === PHP_SESSION_NONE) { // 세션이 시작되어있는지(2) 아닌지(1), 5.4버전 이후부터 가능
            session_start();
        }
        // 유저 로그인 및 권한체크

        // 헤더 드롭다운 리스트 획득
        $boardsCategoryModel = new BoardsCategory();
        $this->arrBoardNameInfo = $boardsCategoryModel->getBoardsNameList();

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