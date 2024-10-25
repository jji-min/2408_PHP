<?php
namespace PHP\oop;

require_once('./Mammal.php');
require_once('./Pet.php');

use PHP\oop\Mammal;
use PHP\oop\Pet;

class FlyingSquirrel extends Mammal implements Pet {
    // private $name;
    // private $residence;

    // // 생성자
    // public function __construct($name, $residence) {
    //     $this->name = $name;
    //     $this->residence = $residence;
    // }

    // // 정보 출력
    // public function printInfo() {
    //     return $this->name.'가 '.$this->residence.'에 삽니다.';
    // }

    // 비행 메소드
    public function flying() {
        return '날아갑니다.';
    }

    // 오버라이딩
    public function printInfo() {
        return ' 룰루랄라';
        // return parent::printInfo().'룰루랄라'; // 부모의 printInfo도 함께 출력
        // 자식 클래스에서 부모의 메소드도 쓰고 싶다면 'parent::' 사용해야함
    }

    public function printPet() {
        return '펫입니다 찍찍';
    }
}