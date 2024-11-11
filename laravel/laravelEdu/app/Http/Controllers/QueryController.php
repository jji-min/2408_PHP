<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class QueryController extends Controller
{
    public function index(Request $request) {
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
        // 쿼리 실행 메소드 -> get(), first(), find(), count() 등

        // select * from users where name = ? ['관리자']
        $result = DB::table('users')
                        ->where('u_name', '=', '관리자')
                        ->get();
        // where(컬럼명, operator, 검색할 값(아무타입 가능))

        // select * from boards where bc_type = ? and b_id < ? ['0', 5]
        $result = DB::table('boards')
                        ->where('bc_type', '=', '0')
                        ->where('b_id', '<', 5)
                        ->get();
        // and로 엮여있을 때는 where로 연결하면 됨

        // select * from boards where bc_type = ? or b_id < ? ['0', 10]
        $result = DB::table('boards')
                        ->where('bc_type', '=', '0')
                        ->orWhere('b_id', '<', 10)
                        ->get();
        // or은 orWhere() 이용

        // select b_title, b_content from boards where b_id in (?, ?) [1, 2]
        $result = DB::table('boards')
                        ->select('b_title', 'b_content')
                        ->whereIn('b_id', [1, 2])
                        ->get();
        // 컬럼명을 지정하려면 select() 사용해야함
        // select문 사용하지 않으면 전체 가져옴(*) -> 현업에서는 '*' 잘 안씀

        // select * from boards where deleted_at is null
        $result = DB::table('boards')
                        ->whereNull('deleted_at')
                        ->get();

        // select * from users where year(created_at) = ? ['2024']
        // 위의 쿼리문은 데이터가 많으면 문제가 생길 수 있음
        // 모든데이터를 다 실행함(100만개 있으면 100만번 실행)
        // -> 인덱스 사용 불가, 모든 데이터 가공한 후 where절로 체크하기 때문에 느려짐
        // 검색할 컬럼에 함수를 씌우면 데이터를 전부 바꾸고 난 후의 결과의 테이블로 비교함 -> 인덱스 사용 불가
        // select * from users where created_at >= '2024-01-01 00:00:00' and created_at <= '2024-12-31 23:59:59'
        // 평문도 알고있어야 문제있는 쿼리문을 튜닝할 수 있음
        $result = DB::table('users')
                        ->whereYear('created_at', '=', '2024')
                        ->get();
        
        // 게시판별 게시글 갯수
        // SELECT bc_type, COUNT(*) cnt FROM boards GROUP BY bc_type
        $result = DB::table('boards')
                        ->select('bc_type', DB::raw('COUNT(*) cnt'))
                        ->whereNull('deleted_at')
                        ->groupBy('bc_type')
                        ->get();
        // DB::raw() -> Maria DB에서 사용하는 함수를 이용하거나, 별칭을 줄 때, 전달해주는 문자열을 쿼리문으로 그대로 사용하도록 해줌
        // DB::raw를 사용하면 다른 데이터베이스로 바꿀 때(Maria DB -> 오라클) 오류가 발생할 수 있음, 설정만 바꾸면 되는 장점을 사용할 수 없음

        // SELECT bc_type, COUNT(*) cnt FROM boards GROUP BY bc_type HAVING bc_type = '0'
        $result = DB::table('boards')
                        ->select('bc_type', DB::raw('COUNT(*) cnt'))
                        ->groupBy('bc_type')
                        ->having('bc_type', '=', '0')
                        ->get();
        // having('cnt', '=', '2') -> select에서 적은 별칭을 having절에서 사용할 수 있음

        // select b_id, b_title from boards order by b_id limit ? offset ? [1, 2]
        $result = DB::table('boards')
                        ->select('b_id', 'b_title')
                        ->orderBy('b_id', 'asc')
                        ->limit(1)
                        ->offset(2)
                        ->get();
        // 오름차순이 default
        // orderByDesc 도 있다고 함
        // 2번째 이후부터 1개 가져옴

        $requestData = [
            'u_id' => 1
        ];
        // null, false, 0, '', [] 의 경우에 when 조건이 실행되지 않음
        $result = DB::table('users')
                        ->when($requestData['u_id'], function($query, $u_id) {
                            $query->where('u_id', '=', $u_id);
                        })
                        ->get();
        // when(체크할 값, 있을 때 체크할 클로저)
        // when절 계속 추가 가능
        // $query는 when이 실행되기 전까지의 정보가 담겨있음

        // 삭제되지 않은 글 중에 제목에 자유 또는 질문이 포함되어 있는 게시글 검색
        // SELECT * FROM boards WHERE deleted_at IS NULL AND (b_title LIKE ? OR b_title LIKE ?)
        $result = DB::table('boards')
                        ->whereNull('deleted_at')
                        ->where(function($query) {
                            $query->where('b_title', 'like', '%자유%')
                                    ->orWhere('b_title', 'like', '%질문%');
                        })
                        ->get();

        // first() : 쿼리 결과 중에 첫번째 레코드만 반환
        $result = DB::table('users')->first();

        // find($id) : 지정된 pk에 해당하는 레코드를 반환, 기본적으로 컬럼명을 id로 인식
        // $result = DB::table('users')->find(1);
        
        // count() : 쿼리 결과의 레코드 수를 반환
        // return값 int
        $result = DB::table('users')->count();

        
        // insert
        // $result = DB::table('users')
        //                 ->insert([
        //                     'u_email' => 'kim@admin.com'
        //                     ,'u_password' => Hash::make('qwer1234')
        //                     ,'u_name' => '김영희'
        //                 ]);

        $arr = [
            'u_email' => 'kim@admin.com'
            ,'u_password' => Hash::make('qwer1234')
            ,'u_name' => '김영희'
        ];
        // $result = DB::table('users')
        //                 ->insert($arr);

        // update
        // $result = DB::table('users')
        //                 ->where('u_id', '=', 7)
        //                 ->update([
        //                     'u_name' => '김철수'
        //                 ]);

        // delete
        // 조건 안주면 싹다 날라갈지도...
        // $result = DB::table('users')
        //                 ->where('u_id', '=', 7)
        //                 ->delete();

        // -------------------------------
        // Eloquent Model
        // -------------------------------
        // $result = DB::table('users')->get();
        // $result = User::get();
        $result = User::where('u_name', '=', '예아')->first();
        // $result = User::find(1);
        // original은 원본 데이터
        // attributes는 수정을 가미한 데이터, 변경되는 데이터
        // $result->u_name = "테스트";
        // 파일안에서만 바뀜, DB가 바뀌지는 않음

        // Insert
        // $userInsert = new User();
        // $userInsert->u_email = $request->u_email;
        // $userInsert->u_password = Hash::make($request->u_password);
        // $userInsert->u_name = $request->u_name;
        // $userInsert->save();
        // 프로퍼티명은 컬럼명과 동일해야함

        // Update
        // $userUpdate = User::find(9);
        // $userUpdate->u_name = '김철수';
        // $userUpdate->save();

        // delete
        // $userDelete = User::destroy(9);

        // 삭제된 데이터도 포함해서 검색하고 싶을 때
        $result = User::withTrashed()->count();
        // withTrashed 없이 그냥 검색하면 null
        // withTrashed 해야 삭제된 데이터도 나옴

        // 삭제된 데이터만 검색하고 싶을 때
        $result = User::onlyTrashed()->count();

        // 삭제된 데이터를 되살리고 싶을 때
        $result = User::where('u_id', 9)->restore(); // '='일 경우에는 생략 가능, 다른건 안됨

        // var_dump($userInsert);
        var_dump($result);
        return '';
    }
}
