<?php

namespace App\Http\Controllers;

use App\Exceptions\MyAuthException;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use MyToken;

class AuthController extends Controller
{
    public function login(UserRequest $request) {
        // 유저 정보 획득
        $userInfo = User::where('account', $request->account)
                    ->withCount('boards')
                    ->first();
                    // 글의 개수도 같이 가져옴

        // 비밀번호 체크
        if(!(Hash::check($request->password, $userInfo->password))) {
            throw new AuthenticationException('비밀번호 체크 오류');
            // 로그인할 때 인증과정 중 에러처리
        }

        // 토큰 발행
        list($accessToken, $refreshToken) = MyToken::createTokens($userInfo);

        // 리프래시 토큰 저장
        MyToken::updateRefreshToken($userInfo, $refreshToken);

        $responseData = [
            'success' => true
            ,'msg' => '로그인 성공'
            ,'accessToken' => $accessToken
            ,'refreshToken' => $refreshToken
            ,'data' => $userInfo->toArray()
        ];
        return response()->json($responseData, 200);
    }

    /**
     * 로그아웃
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return response JSON
     */
    public function logout(Request $request) {
        // 페이로드에서 유저 id 획득
        $id = MyToken::getValueInPayload($request->bearerToken(), 'idt');

        DB::beginTransaction();

        // 유저 정보 획득
        $userInfo = User::find($id);

        // 리프래시 토큰 갱신
        MyToken::updateRefreshToken($userInfo, null);

        DB::commit();

        $responseData = [
            'success' => true
            ,'msg' => '로그아웃 성공'
        ];

        return response()->json($responseData, 200);
    }

    /**
     * 토큰 재발급 처리
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return response JSON
     */
    public function reissue(Request $request) {
        // 페이로드에서 유저 PK 획득
        $userId = MyToken::getValueInPayload($request->bearerToken(), 'idt');

        // 유저 정보 획득
        $userInfo = User::find($userId);

        // 리프래시 토큰 비교
        if($request->bearerToken() !== $userInfo->refresh_token) {
            throw new MyAuthException('E22');
        }

        // 토큰 발급
        list($accessToken, $refreshToken) = MyToken::createTokens($userInfo);
        // accessToken : 인증 절차와 관련 / refreshToken : accessToken 재발급을 위함, 일회용

        // 리프래시 토큰 저장
        MyToken::updateRefreshToken($userInfo, $refreshToken);

        $responseData = [
            'success' => true
            ,'msg' => '토큰 재발급 성공'
            ,'accessToken' => $accessToken
            ,'refreshToken' => $refreshToken
        ];

        return response()->json($responseData, 200);
    }
}
