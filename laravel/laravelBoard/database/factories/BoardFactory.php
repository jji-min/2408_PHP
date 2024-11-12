<?php

namespace Database\Factories;

use App\Models\BoardsCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Board>
 */
class BoardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $arrImg = [
            '/img/mang1.jfif'
            ,'/img/mang2.png'
            ,'/img/mang3.png'
            ,'/img/mang4.png'
            ,'/img/mang5.png'
        ];
        
        $userInfo = User::inRandomOrder()->first();
        $date = $this->faker->dateTimeBetween($userInfo->create_at);
        // 해당 회원이 가입한 날짜 이후의 날짜가 입력됨

        return [
            'u_id' => $userInfo->u_id // inRandomOrder() : 랜덤으로 정렬
            ,'bc_type' => BoardsCategory::inRandomOrder()->first()->bc_type
            ,'b_title' => $this->faker->realText(50) // 글자 길이만큼 랜덤하게 나옴
            ,'b_content' => $this->faker->realText(200)
            ,'b_img' => Arr::random($arrImg) // $arrImg를 랜덤하게 가져옴
            ,'created_at' => $date
            ,'updated_at' => $date
        ];
    }
}
