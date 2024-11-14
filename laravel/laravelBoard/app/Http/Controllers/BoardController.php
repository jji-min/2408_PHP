<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // 여러개의 데이터 화면에 출력(리스트페이지)
    {
        // 리스트 데이터 획득
        $result = Board::select('b_id', 'b_title', 'b_content', 'b_img')
                    ->orderBy('created_at', 'DESC')
                    ->orderBy('b_id', 'DESC')
                    ->get();
        // eloquent model로 가져오면 softdelete된 데이터는 자동으로 안 가져옴

        return view('boardList')->with('data', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() // 작성페이지로 이동
    {
        return view('insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // 작성 처리
    {
        // 유효성 체크
        $validator = Validator::make(
            $request->only('b_title', 'b_content', 'file')
            ,[
                'b_title' => ['required', 'max:50']
                ,'b_content' => ['required', 'max:200']
                ,'file' => ['required', 'image']
            ]
        );

        if($validator->fails()) {
            return redirect()
                    ->route('boards.create')
                    ->withErrors($validator->errors());
        }

        // 데이터 삽입
        try {
            DB::beginTransaction();
    
            Board::create([
                'u_id'
                ,'bc_type'
                ,'b_title' => $request->b_title
                ,'b_content' => $request->b_content
                ,'b_img'
            ]);
            DB::commit();
        } catch(Throwable $th) {
            DB::rollBack();
            // transaction이 실행되어있어야 롤백처리함
            // 그래서 inTransation 체크할 필요 없음
        }

        return redirect()->route('boards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // 상세 데이터를 만들어서 보내줌, 상세 정보 전달(예시:디테일 페이지로 이동)
    {
        Log::debug('****** boards.show Start ******');
        Log::debug('request id : '.$id);

        $result = Board::find($id); // eloquent 모델 객체

        Log::debug('획득 상세 데이터', $result->toArray()); // 배열로 바꿔줌

        return response()->json($result->toArray()); // json의 파라미터는 기본적으로 배열
        // 라라벨이 eloquent model일 경우에 json에서 자동으로 배열로 변환해서 작업함
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // 해당 게시글의 수정페이지로 이동
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // 수정 처리
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // 삭제(요즘은 삭제페이지보다 모달 등을 이용함)
    {
        //
    }
}
