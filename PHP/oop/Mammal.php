<?php
namespace PHP\oop;
// 경로를 적어주는 것이 일반적
// 파일이 중복될 수 있으므로 위치를 지정해줌
// namespace는 최상단에 해야함

// 추상클래스
abstract class Mammal { // abstract를 적은 키워드는 자식쪽에서 반드시 오버라이딩해서 재정의 해야함
    private $name;
    private $residence;

    // 생성자
    public function __construct($name, $residence) {
        $this->name = $name;
        $this->residence = $residence;
    }

    // 추상 메소드
    // 처리부분을 자식에게 강제로 맡김, 그래서 처리부분 필요없음
    abstract public function printInfo();
}







// class Mammal {
//     private $name;
//     private $residence;

//     // 생성자
//     public function __construct($name, $residence) {
//         $this->name = $name;
//         $this->residence = $residence;
//     }

//     // 정보 출력
//     public function printInfo() {
//         return $this->name.'가 '.$this->residence.'에 삽니다.';
//     }

//     // 'final'이라는 키워드를 메소드 앞에 붙이면,
//     // 자식에서 오버라이딩하지 못하도록 방지할 수 있음
//     // final public function printInfo() {
//     //     return $this->name.'가 '.$this->residence.'에 삽니다.';
//     // }
// }