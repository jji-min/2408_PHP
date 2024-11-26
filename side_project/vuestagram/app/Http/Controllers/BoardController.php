<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

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
}
