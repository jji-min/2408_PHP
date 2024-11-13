<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * 로그인 페이지로 이동
     */
    public function goLogin() {
        return view('login');
    }

    /**
     * 로그인 처리
     */
    public function login(Request $request) {
        Log::debug("리퀘스트 데이터", $request->only('u_email', 'u_password'));
        // 유효성 체크
        $validator = Validator::make(
            $request->only('u_email', 'u_password') // only() : 가져오고 싶은 해당 키의 데이터들을 연관배열로 가져옴
            ,[
                'u_email' => ['required', 'email', 'exists:users,u_email']
                // 이메일이 존재하면 통과, 없으면 통과안됨
                // exists:users,u_email 사이에 공백있으면 안됨(문자열이라서)
                ,'u_password' => ['required', 'between:6,20', 'regex:/^[a-zA-Z0-9!@]+$/']
                // min:6, max:20, integer 넣으면 숫자 6~20으로 인식함 -> integer라는 속성 때문
                // regex의 +는 1글자 이상이라는 뜻
            ]
            // 룰(규칙)

            // 파라미터 전부 배열로 전달하면 됨
        );

        if($validator->fails()) { // fails() : 유효성 체크를 했을 때 실패하면 true
            return redirect()
                    ->route('goLogin')
                    ->withErrors($validator->errors());
        }

        // 회원 정보 획득
        $userInfo = User::where('u_email', '=', $request->u_email)->first(); // 한개만 가져오면 되기 때문에 first 사용

        // 비밀번호 체크
        if(!(Hash::check($request->u_password, $userInfo->u_password))) {
            return redirect()->route('goLogin')->withErrors('비밀번호가 일치하지 않습니다.');
        }

        // 유저 인증 처리
        Auth::login($userInfo); // 로그인 처리 끝
        // 세션처리는 라라벨이 알아서 해줌

        // var_dump(Auth::id()); // 로그인한 유저의 pk 획득
        // var_dump(Auth::user()); // 로그인한 유저의 정보 획득
        // var_dump(Auth::check()); // 로그인 여부 체크(되어 있으면 true)

        return redirect()->route('boards.index'); // resource로 만들어서 다음과 같이 route를 적어야 함
    }
    // 라우트(클로저)에서 쓰는거랑 동일하게 쓰면됨

    /**
     * 로그아웃 처리
     */
    public function logout() {
        Auth::logout(); // 로그아웃 처리

        Session::invalidate(); // 기존 세션의 모든데이터 제거 및 새로운 세션 ID 발급
        Session::regenerateToken(); // CSRF 토큰 재발급

        // 로그아웃 만들 때 위의 세줄은 반드시 적어야함!

        return redirect()->route('goLogin');
    }
}
