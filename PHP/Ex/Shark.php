<?php
// 클래스명의 젤 앞글자는 대문자
class Shark {
    public $name;

    // 생성자 (Construct)
    // 객체를 인스턴스화 할 때, 딱 한번만 실행되는 메소드
    // 초기 세팅하고 싶을 때 사용
    public function __construct($name) {
        $this->name = $name;
        $this->info();
    }

    private function info() {
        return "안녕";
    }
}