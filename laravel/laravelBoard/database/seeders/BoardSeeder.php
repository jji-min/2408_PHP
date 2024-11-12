<?php

namespace Database\Seeders;

use App\Models\Board;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Board::factory(100)->create();

        // 30만개 만들려면
        for($i = 0; $i < 60; $i++) {
            Board::factory(5000)->create();
        }
        // 그냥 30만개 만들어버리면 멈출수도 있음

        $total = 100;
        $interval = 50;

        for($i = 0; $i < $total; $i += $interval) {
            Board::factory($interval)->create();
        }
    }
}
