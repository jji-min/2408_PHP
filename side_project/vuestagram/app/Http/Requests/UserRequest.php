<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'account' => ['required', 'between:5,20', 'regex:/^[0-9a-zA-Z]+$/']
            ,'password' => ['required', 'between:5,20', 'regex:/^[0-9a-zA-Z!@]+$/']
        ];

        // 로그인
        if($this->routeIs('auth.login')) {
            $rules['account'][] = 'exists:users,account';
        } else if($this->routeIs('user.store')) {
            // 회원가입
            $rules['account'][] = 'unique:users,account';
            $rules['password_chk'] = ['same:password'];
            $rules['name'] = ['required', 'between:1,20', 'regex:/^[가-힣]+$/u']; // regex의 마지막 u는 유니코드로 인식시키겠다는 뜻
            $rules['gender'] = ['required', 'regex:/^[0-1]{1}$/']; // 한글자만 올 수 있음
            $rules['profile'] = ['required', 'image']; // min,max 주면 용량도 제한할 수 있음, max:2하면 메가바이트로 체크됨
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator) {
        // validation 실패했을 때 자동으로 실행
        $response = response()->json([
            'success' => false,
            'message' => '유효성 체크 오류',
            'data' => $validator->errors()
        ], 422); // Httpcode가 200번대와 300번대는 정상, 나머지는 자동으로 catch로 들어감
        // Httpcode는 각각 어떤 에러인지 정해져있음

        throw new HttpResponseException($response);
    }
}
