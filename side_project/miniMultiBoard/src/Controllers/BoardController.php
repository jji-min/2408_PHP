<?php

namespace Controllers;

use Controllers\Controller;
use Models\Board;
use Models\BoardsCategory;

class BoardController extends Controller {
    private $arrBoardList = []; // 게시글 정보 리스트
    // 외부에서 함부로 접근, 수정 못하도록 하기 위해
    private $boardName = ''; // 게시판 이름
    protected $boardType = ''; // 게시판 코드

    // getter
    public function getArrBoardList() { // 데이터 가져옴
        return $this->arrBoardList;
    }
    public function getBoardName() {
        return $this->boardName;
    }

    // setter
    public function setArrBoardList($arrBoardList) { // 데이터 수정
        $this->arrBoardList = $arrBoardList;
    }
    public function setBoardName($boardName) {
        $this->boardName = $boardName;
    }

    public function index() {
        // 보드타입 획득
        $requestData = [
            'bc_type' => isset($_GET['bc_type']) ? $_GET['bc_type'] : '0'
        ];
        $this->boardType = $requestData['bc_type'];

        // 게시글 정보 획득
        $boardModel = new Board();
        $this->setArrBoardList($boardModel->getBoardList($requestData));

        // 보드 이름 획득
        $boardCategoryModel = new BoardsCategory();
        $resultBoardCategory = $boardCategoryModel->getBoardName($requestData);
        $this->setBoardName($resultBoardCategory['bc_name']);
        
        // $this->setBoardName($boardCategoryModel->getBoardName($requestData)['bc_name']);
        // 형태는 다르지만 같음

        return 'board.php';
    }

    // 상세
    public function show() {
        $requestData = [
            'b_id' => $_GET['b_id']
        ];

        // 게시글 정보 조회
        $boardModel = new Board();
        $resultBoard = $boardModel->getBoardDetail($requestData);

        // JSON(데이터의 형태) 변환
        // AJAX를 이용하는데 axios라는 라이브러리를 사용하고 JSON이라는 데이터 형태로 통신
        $responseData = json_encode($resultBoard);

        header('Content-type: application/json'); // json으로 보냈다는 것을 명시해줌, string으로 반환
        // JSON이라고 명시를 해줘야 버그가 안남
        echo $responseData;
        exit;
    }

    // 작성 페이지로 이동
    public function create() {
        $this->boardType = $_GET['bc_type'];
        return 'insert.php';
    }

    // 작성 처리
    public function store() {
        $requestData = [
            'b_title' => $_POST['b_title']
            ,'b_content' => $_POST['b_content']
            ,'b_img' => ''
            ,'bc_type' => $_POST['bc_type']
            ,'u_id' => $_SESSION['u_id']
        ];

        $requestData['b_img'] = $this->saveImg($_FILES['file']);

        $boardModel = new Board();
        $boardModel->beginTransaction();
        $resultBoardInsert = $boardModel->insertBoard($requestData);

        if($resultBoardInsert !== 1) {
            $boardModel->rollBack();
            $this->arrErrorMsg[] = '게시글 작성 실패';
            $this->boardType = $requestData['bc_type'];
            return 'insert.php';
        }

        $boardModel->commit();

        return 'Location: /boards?bc_type='.$requestData['bc_type'];
    }

    private function saveImg($file) {
        $type = explode('/', $file['type']); // ['IMAGE', '확장자'], '/'기준으로 잘라서 배열로 만듬
        $fileName = uniqid().'.'.$type[1]; // 3gjdklsdf.확장자, $type[1]에는 확장자(png, jpg 등)가 들어감
        $filePath = _PATH_IMG.'/'.$fileName; // /view/img/3gjdklsdf.확장자, 파일이 저장될 경로
        move_uploaded_file($file['tmp_name'], _ROOT.$filePath); // 파일 복사

        return $filePath;
    }
}