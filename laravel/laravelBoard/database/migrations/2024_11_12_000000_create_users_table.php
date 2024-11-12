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
        Schema::create('users', function (Blueprint $table) {
            $table->id('u_id');
            $table->string('u_email', 100)->unique(); // 중복되면 안되니까 unique()
            $table->string('u_password', 255); // 라라벨에서 제공하는 암호화사용할것, insert할 때 자동으로 암호화하려면 db에서 작업해야함
            $table->string('u_name', 50);
            $table->timestamps(); // 작성일자 및 수정일자
            $table->softDeletes(); // 삭제일자
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
