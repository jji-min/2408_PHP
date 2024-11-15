<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardsCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) // 여러개의 데이터 화면에 출력(리스트페이지)
    {
        // 게시글 타입 획득
        $bcType = '0';
        if($request->has('bc_type')) { // request에 bc_type이 존재하는지 true, false로 반환
            $bcType = $request->bc_type;
        }

        // 리스트 데이터 획득
        $result = Board::select('b_id', 'b_title', 'b_content', 'b_img')
                    ->where('bc_type', $bcType) // '='은 생략가능
                    ->orderBy('created_at', 'DESC')
                    ->orderBy('b_id', 'DESC')
                    ->get();
        // eloquent model로 가져오면 softdelete된 데이터는 자동으로 안 가져옴

        // 게시판 이름 획득
        $boardInfo = BoardsCategory::where('bc_type', $bcType)->first();

        return view('boardList')
                ->with('data', $result)
                ->with('boardInfo', $boardInfo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) // 작성페이지로 이동
    {
        // return view('insert');
        return view('boardInsert')->with('bcType', $request->bc_type);
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
        $request->validate([
            'b_title' => ['required', 'between:1,50']
            ,'b_content' => ['required', 'between:1,200']
            ,'file' => ['required', 'image'] // 이미지에 대한 모든 정보를 담은 객체가 넘어옴
            ,'bc_type' => ['required', 'exists:boards_category,bc_type']
        ]);
        // 요청이 왔던 이전 페이지로 자동으로 이동함
        // 에러메세지도 이전화면으로 전달됨
        // 무조껀 요청이 오기 직전의 페이지로 이동함
        // redirect를 통해 원하는 페이지로 넘어갈 수 없음
        // 아래 방법으로 하면 with으로 데이터도 같이 넘겨줄 수 있었는데 지금 방법은 with는 못씀

        // $validator = Validator::make(
        //     $request->only('b_title', 'b_content', 'file')
        //     ,[
        //         'b_title' => ['required', 'between:1,50']
        //         ,'b_content' => ['required', 'between:1,200']
        //         ,'file' => ['required', 'image']
        //     ]
        // );

        // if($validator->fails()) {
        //     return redirect()
        //             ->route('boards.create')
        //             ->withErrors($validator);
        // }

        $filePath = ''; // 초기화
        try {
            // 파일저장
            $filePath = $request->file('file')->store('img'); // 기본적으로 경로가 public까지 잡혀있기 때문에 img만 적어주면 됨
            // 'img/~~~.jpg'와 같이 자동으로 경로가 생성됨

            DB::beginTransaction();
            // 글 작성 처리
            $insertData = $request->only('b_title', 'b_content', 'bc_type');
            $insertData['b_img'] = '/'.$filePath;
            $insertData['u_id'] = Auth::id(); // 웹 서버에 저장된 값, 바뀌지 않는 값, 세션에 저장된 것은 유효성 검사 안함
            Board::create($insertData);
            DB::commit();
        } catch(Throwable $th) {
            DB::rollBack();
            if(Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }
        // 파일저장은 성공하고, 글 작성을 실패해서 롤백하면 저장된 파일도 삭제해줘야 함

        return redirect()->route('boards.index', ['bc_type' => $request->bc_type]);
        // route()의 두번째 파라미터에 전달할 값을 배열로 주면됨

        // 데이터 삽입
        // try {
        //     DB::beginTransaction();
    
        //     Board::create([
        //         'u_id'
        //         ,'bc_type'
        //         ,'b_title' => $request->b_title
        //         ,'b_content' => $request->b_content
        //         ,'b_img'
        //     ]);
        //     DB::commit();
        // } catch(Throwable $th) {
        //     DB::rollBack();
        //     // transaction이 실행되어있어야 롤백처리함
        //     // 그래서 inTransation 체크할 필요 없음
        // }

        // return redirect()->route('boards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // 상세 데이터를 만들어서 보내줌, 상세 정보 전달(예시:디테일 페이지로 이동)
    {
        // Log::debug('****** boards.show Start ******');
        // Log::debug('request id : '.$id);

        $result = Board::find($id); // eloquent 모델 객체

        $responseData = $result->toArray();
        $responseData['delete_flg'] = $result->u_id === Auth::id(); // 같으면 true, 다르면 false 저장

        // Log::debug('획득 상세 데이터', $result->toArray()); // 배열로 바꿔줌

        return response()->json($responseData); // json의 파라미터는 기본적으로 배열
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
        $result = Board::destroy($id); // 해당 레코드 수 반환

        $responseData = [
            'success' => $result === 1 ? true : false
        ];

        return response()->json($responseData);
    }
}
