<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // 마이그레이션 파일 생성 : php artisan make:migration 파일명
    // 마이그레이션 실행 : php artisan migrate
    // 마이그레이션 롤백(직전의 마이그레이션 작업 되돌리기) : php artisan migrate:rollback
    // 마이그레이션 리셋(모든 마이그레이션 작업 되돌리기) : php artisan migrate:reset
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 자동으로 테이블 복수형
        // 아래 코드는 고정
        Schema::create('boards_test', function (Blueprint $table) {
            $table->id('b_id'); // unsigned가 들어간 bigint PK를 만듦, 파라미터로 원하는 컬럼명 지정 가능
            // $table->bigInteger('u_id', false, true);
            $table->bigInteger('u_id')->unsigned(); // 위의 코드와 같이 파라미터를 일일히 쓰고 싶지 않으면 체이닝 메소드 사용 가능
            $table->char('bc_type', 1);
            $table->string('b_title', 50); // varchar는 string
            $table->string('b_content', 200);
            $table->string('b_img', 100);
            // $table->timestamps(); // created_at, updated_at 자동 생성, null허용되어있음 -> 지정하지 않아도 model에서 알아서 관리해서 null값 들어가지 않음
            // 위의 코드 쓰기 싫으면 일일히 만드는 방법도 있음, 일반적으로는 timestamps()를 사용함
            $table->timestamp('created_at')->default(DB::raw('current_timestamp')); // 기본이 null허용이 아님
            $table->timestamp('updated_at')->default(DB::raw('current_timestamp'));
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // up과 반대되는 처리해줘야 함
    // up-create, down-drop / up-drop, down-create
    public function down()
    {
        Schema::dropIfExists('boards_test'); // 테이블 drop
    }
};
