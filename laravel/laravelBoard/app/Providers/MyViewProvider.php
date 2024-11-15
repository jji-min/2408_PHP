<?php

namespace App\Providers;

use App\Models\BoardsCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MyViewProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['boardList', 'boardInsert'], function($view) {
            // '*' 넣으면 모든 뷰에서 얘를 실행하겠다는 의미
            // 특정 뷰만 설정하려면 해당 뷰 이름을 적으면 됨
            // 여러개 적으려면 배열 형식(ex. ['boardList', 'boardInsert'])
            // $view : 뷰를 랜더링한 정보를 담고 있는 객체, 쪼개져 있는 화면을 다 가지고있는 화면
            
            $resultBoardCategoryInfo = BoardsCategory::orderBy('bc_type')->get();
            $view->with('myGlobalBoardsCategoryInfo', $resultBoardCategoryInfo);
        });
    }
}
