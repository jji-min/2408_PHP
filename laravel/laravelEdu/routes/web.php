<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ------------------
// 라우트 정의
// ------------------
Route::get('/hi', function() {
    return '안녕하세요';
});

Route::get('/hello', function() {
    return 'hello';
});

Route::get('/myview', function() {
    return view('myView');
});

// -----------------------
// httpMethod에 대응하는 라우터
// -----------------------
Route::get('/home', function() {
    return view('home');
});
// 클로저 -> 함수

Route::post('/home', function() {
    return 'HOME POST';
});

Route::put('/home', function() {
    return 'HOME PUT';
});

Route::delete('/home', function() {
    return 'HOME DELETE';
});

Route::patch('/home', function() {
    return 'HOME PATCH';
});

// ------------------------
// 파라미터 제어
// ------------------------
Route::get('/param', function(Request $request) {
    return 'ID : '.$request->id.' NAME : '.$request->name;
});
// http://localhost:8000/param?id=1111&name=tt
// $request는 _SERVER, 쿠키등 모든 정보를 가지고 있음
// $request는 객체
// Request는 타입힌트


// 세그먼트 파라미터
// http://localhost:8000/param/1111
// http://localhost:8000/param/1111/tt
// url의 path처럼 파라미터를 받을 수 있음
Route::get('/param/{id}/{name}', function($id, $name) {
    return $id.' : '.$name;
});
// {id}에 들어가는 값과 $id의 이름은 같아야 함
// 단순히 id 하나만 보내주면 될때는 세그먼트 파라미터로 보내줄때가 많음
Route::get('/param/{id}', function(Request $request) {
    return $request->id;
});
// 세그먼트 파라미터 하나만 필요한게 아니라 여러가지가 필요하면,
// Request로 다 받아오면 됨
Route::get('/param2/{id}', function(Request $request, $id) {
    return $request->id."  ".$id;
});
// url이 중복되면 에러 안뜸, 중복되면 마지막꺼 적용됨
// 세그먼트 파라미터 까지가 경로, 규칙임

// 세그먼트 파라미터의 디폴트 설정
// 전달받으면 전달받은 값을 쓰고 아니면 디폴트 값을 사용
// url이 똑같은 라우트가 있으면 위에 있는 것이 실행됨
// 세그먼트 파라미터의 디폴트 설정, 중복된 경로의 라우트가 설정되지 않도록 주의
// 라우트 경로가 중복될 수 있으니 되도록이면 안쓰는게 좋음
// Route::get('/param3', function() {
//     return '파람3이다.';
// });
Route::get('/param3/{id?}', function(int $id = 0) {
    return $id;
});

// --------------------
// 라우트명 지정
// --------------------
Route::get('/name', function() {
    return view('name');
});

Route::get('/home/na/hon/php', function() {
    return '좀 긴 패스';
})->name('long');
// name() : 해당 라우트의 이름을 지어줌
// 유지보수성이 올라감
// <h1>좀 긴 패스</h1> 도 가능 -> html은 문자열이니까

// --------------------
// 뷰에 데이터를 전달
// --------------------
Route::get('/send', function() {
    $result = [
        ['id' => 1, 'name' => '홍길동']
        ,['id' => 2, 'name' => '갑순이']
    ];
    // return view('send')
    //         ->with('gender', '무성') // key : gender, value : 무성
    //         ->with('data', $result);

    // with를 여러개 쓰는 대신 배열로 만들어서 가능
    return view('send')
            ->with([
                'gender' => '무성'
                ,'data' => $result
            ]);
});

// ------------------
// 대체 라우트
// ------------------
// 우리가 지정한 거 외에 나머지 전부를 잡아주는 라우트
// fallback은 하나만 있으면 됨
Route::fallback(function() {
    return '이상한 URL 입니다.';
});

// ------------------
// 라우트 그룹
// ------------------
// Route::get('/users', function() {
//     return 'GET : /users';
// });
// Route::post('/users', function() {
//     return 'POST : /users';
// });
// Route::put('/users/{id}', function() {
//     return 'PUT : /users';
// });
// Route::delete('/users/{id}', function() {
//     return 'DELETE : /users';
// });

Route::prefix('/users')->group(function() {
    Route::get('/', function() {
        return 'GET : /users';
    });
    Route::post('/', function() {
        return 'POST : /users';
    });
    Route::put('/{id}', function() {
        return 'PUT : /users';
    });
    Route::delete('/{id}', function() {
        return 'DELETE : /users';
    });
});
// 미들웨어 사용할 때 group 사용함
// 같은 기능을 하는 라우터라는거 인식
// 예를 들어, '/boards로 시작하면 게시판과 관련된 기능을 한다는 것을 알 수 있음
// prefix -> 공통된 접두사 지정