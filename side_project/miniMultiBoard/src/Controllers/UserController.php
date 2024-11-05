<?php
// 자식
namespace Controllers;

use Controllers\Controller;
use Lib\UserValidator;
use Models\User;

class UserController extends Controller {
    protected function goLogin() {
        return 'login.php';
    }

    protected function login() {
        // 유저 입력 정보 획득
        $requestData = [
            'u_email' => $_POST['u_email']
            ,'u_password' => $_POST['u_password']
        ];

        // 유효성 체크
        $resultValidator = UserValidator::chkValidator($requestData);
        if(count($resultValidator) > 0) {
            $this->arrErrorMsg = $resultValidator;
            return 'login.php';
        }
        
        // 유저정보 획득
        $userModel = new User();
        $prepare = [
            'u_email' => $requestData['u_email']
        ];
        $resultUserInfo = $userModel->getUserInfo($prepare);

        // var_dump($resultUserInfo);
        // var_dump(password_hash($requestData['u_password'], PASSWORD_DEFAULT));
        // exit;

        // 유저 존재 유무 체크
        if(!$resultUserInfo) { // 값이 있으면 true
            $this->arrErrorMsg[] = '존재하지 않는 유저입니다.';
            return 'login.php';
        } else if(!password_verify($requestData['u_password'], $resultUserInfo['u_password'])) { // 비밀번호가 같은지 확인
            // 패스워드 체크
            $this->arrErrorMsg[] = '패스워드가 일치하지 않습니다.';
            return 'login.php';
        }

        // 세션에 u_id 저장
        $_SESSION['u_email'] = $resultUserInfo['u_email'];
        
        // 로케이션 처리
        return 'Location: /boards'; // url을 변경하기 위해서 Location 처리
    }
}
// // 비밀번호 암호화
// $encryptPassword = password_hash($requestData['u_password'], PASSWORD_DEFAULT);
// password_verify(); // 비밀번호가 같은지 확인
// 기본적인 알고리즘 방식으로 암호화
// 암호화를 다시하면 값이 다르게 나옴