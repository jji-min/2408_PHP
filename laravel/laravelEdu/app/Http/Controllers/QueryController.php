<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
    public function index() {
        // --------------------
        // 쿼리빌더
        // --------------------
        // 쿼리빌더를 이용하지 않고 SQL 작성
        // $data = [
        //     'u_email' => 'admin@admin.com'
        // ];

        $result = DB::select('SELECT * FROM users');
        // $result = DB::select('SELECT * FROM users WHERE u_email = :u_email', $data);
        $result = DB::select('SELECT * FROM users WHERE u_email = :u_email', ['u_email' => 'admin@admin.com']);
        $result = DB::select('SELECT * FROM users WHERE u_email = ?', ['admin@admin.com']); // key를 지정하지 않음, 순서대로 작성하면 됨
        // 1차원 배열, 안에 객체(object)가 들어있음
        // 평문 -> 쿼리문을 다 작성한 것(join문 등을 쓸 때)

        // insert
        // DB::insert('INSERT INTO boards_category (bc_type, bc_name) VALUES(?, ?)', ['3', '테스트게시판']);
        // DB::beginTransaction(); // begintransaction 있음

        // update
        // DB::update('UPDATE boards_category SET bc_name = ? WHERE bc_type = ?', ['미어켓게시판', '3']);

        // delete
        // DB::delete('DELETE FROM boards_category WHERE bc_type = ?', ['3']);

        // ----------------------
        // 쿼리 빌더 체이닝
        // ----------------------
        // users 테이블 모든 데이터 조회
        // select * from users;
        $result = DB::table('users')->get();

        var_dump($result);
        return '';
    }
}
