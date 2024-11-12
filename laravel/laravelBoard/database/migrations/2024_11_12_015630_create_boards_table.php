<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->id('b_id');
            $table->bigInteger('u_id', false, true); // fk는 모든게 똑같아야함
            $table->char('bc_type', 1);
            $table->string('b_title', 50);
            $table->string('b_content', 200);
            $table->string('b_img', 100);
            $table->timestamps(); // 모델이 자동으로 관리해줄 것이기 때문에 default값은 따로 지정안함
            // 테이블의 구조도 current를 넣고 싶다면 timestamp를 이용하여 컬럼 하나하나 만들면 됨
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards');
    }
};
