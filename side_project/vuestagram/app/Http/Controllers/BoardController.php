<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use MyToken;

class BoardController extends Controller
{
    public function index() {
        $boardList = Board::orderBy('created_at', 'DESC')->paginate(8);
        // 숫자만 적어주면 라라벨이 알아서 offset을 조절해줌

        $responseData = [
            'success' => true
            ,'msg' => '게시글 획득 성공'
            ,'boardList' => $boardList->toArray()
        ];

        return response()->json($responseData, 200);
    }

    public function show($id) {
        // $board = Board::join('users', 'boards.user_id', '=', 'users.user_id')
        //                 ->select('boards.*', 'users.name')
        //                 ->find($id);
        // join문 : softDelete 인식안됨, 삭제된 데이터도 가져올 수 있음
        $board = Board::with('user')->find($id);
        // Board.php의 user 메소드
        // join문 대신이자 n+1의 문제 해결을 위해 relationship 사용

        $responseData = [
            'success' => true
            ,'msg' => '상세 정보 획득 성공'
            ,'board' => $board->toArray()
        ];

        return response()->json($responseData, 200); 
    }

    public function store(Request $request) {
        // TODO 유효성체크 넣어주세요.

        // insert data
        $insertData = $request->only('content');
        $insertData['user_id'] = MyToken::getValueInPayload($request->bearerToken(), 'idt');
        $insertData['like']= 0;
        $insertData['img'] = '/'.$request->file('file')->store('img'); // 해당경로에 '/'붙여서 'img'에 넣음

        // insert
        $board = Board::create($insertData);

        $responseData = [
            'success' => true
            ,'msg' => '게시글 작성 성공'
            ,'board' => $board->toArray()
        ];

        return response()->json($responseData, 200);
    }
}
