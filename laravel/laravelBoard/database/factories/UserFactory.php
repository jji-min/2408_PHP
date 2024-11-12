<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-1 years');
        // 오늘날짜로부터 과거 1년사이의 랜덤한 날짜를 가져옴

        return [
            'u_email' => $this->faker->unique()->safeEmail() // 중복되지 않게
            ,'u_password' => Hash::make('qwer1234') // password
            ,'u_name' => $this->faker->name() // 원래는 영어로 생성되는데 config->app.php에서 ko_KR로 바꿔서 한글로 생성됨
            ,'created_at' => $date
            ,'updated_at' => $date
        ];
        // 레코드 하나에 대한 데이터
    }
}
