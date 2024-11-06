<?php

namespace Route;

use Controllers\BoardController;
use Controllers\UserController;

// 라우트 : 유저의 요청을 분석해서 해당 Controller로 연결해주는 클래스
// 라우트는 생성자만 가짐
class Route {
    // 생성자
    public function __construct() {

        $url = isset($_GET['url']) ? $_GET['url'] : ''; // 요청 경로 획득
        $httpMethod = $_SERVER['REQUEST_METHOD']; // HTTP 메소드 획득

        // 요청 경로 체크
        if($url === '') {
            header('Location: /login');
            exit;
        } else if($url === 'login') {
            // 회원 로그인 관련
            if($httpMethod === 'GET') {
                new UserController('goLogin');
            } else if($httpMethod === 'POST') {
                new UserController('login');
            }
        } else if($url === 'boards') {
            if($httpMethod === 'GET') {
                new BoardController('index');
            }
        } else if($url === 'logout') {
            if($httpMethod === 'GET') {
                new UserController('logout');
            }
        } else if($url === 'regist') {
            if($httpMethod === 'GET') {
                new UserController('goRegist');
            } else if($httpMethod === 'POST') {
                new UserController('regist');
            }
        } else if($url === 'boards/detail') {
            if($httpMethod === 'GET') {
                new BoardController('show');
            }
        } else if($url === 'boards/insert') {
            if($httpMethod === 'GET') {
                new BoardController('create');
            } else if($httpMethod === 'POST') {
                new BoardController('store');
            }
        }
    }
}