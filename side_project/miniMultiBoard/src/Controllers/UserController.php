<?php
// 자식
namespace Controllers;

use Controllers\Controller;

class UserController extends Controller {
    protected function goLogin() {
        return 'login.php';
    }
}