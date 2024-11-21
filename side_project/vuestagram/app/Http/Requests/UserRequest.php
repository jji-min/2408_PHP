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

        if($this->routeIs('post.login')) {
            $rules['account'][] = 'exists:users,account';
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
