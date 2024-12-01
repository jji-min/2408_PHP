<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * 예외 및 에러가 발생했을 때 호출되며,
     * 주로 로깅이나 외부 서비스에 보고를 하기위한 작업 수행
     */
    public function report(Throwable $th) {
        Log::info('Report : '.$th->getMessage());
    }

    /**
     * 에러 메세지 리스트
     */
    public function context() {
        return [
            'E01' => ['status' => 401, 'msg' => '인증 실패']
            ,'E80' => ['status' => 500, 'msg' => 'DB 에러가 발생했습니다.']
            ,'E99' => ['status' => 500, 'msg' => '시스템 에러가 발생했습니다.']
        ];
    }
}
