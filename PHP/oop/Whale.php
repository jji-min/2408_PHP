<?php
namespace PHP\oop;

require_once('./Mammal.php'); // 안의 소스코드를 들고옴
require_once('./Swim.php');

use PHP\oop\Mammal;
use PHP\oop\Swim;

class Whale extends Mammal implements Swim {
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

    // 수영 메소드
    public function swimming() {
        return '수영 합니다.';
    }

    public function printInfo() {
        return "고래고래고래";
    }
}







// ------------------------------------------------------------------------------
// 필드 : class내부 영역
// 프로퍼티 : class내부(필드)에 정의된 변수
// 메소드 : class내부(필드)에 정의된 함수

// class Whale { // class명의 첫글자는 대문자, class명과 파일명이 동일해야함
//     // 프로퍼티
//     // public $name = "고래";
//     // private $age = 20;
//     public $name;
//     private $age;
//     // 접근제어 지시자는 캡슐화와 관련(외부로부터 데이터 보호)
//     // public : 외부에서 접근 가능(외부에서 접근해야하는 기능도 있음), 변경 가능
//     // private는 메소드를 통해서만 접근가능

//     // 생성자 메소드
//     // 무조껀 최초 1회 실행됨
//     // 초기값을 세팅해주는 용도로 많이 사용, 최초에 실행되어야 하는 연산 등에 사용
//     public function __construct($name, $age) { // 무조껀 public이고, 이와 같은 이름으로 만들어야 함
//         // echo "생성자 실행 됨";
//         $this->name = $name;
//         $this->age = $age;
//     }

//     // 메소드
//     public function breath() {
//         return "숨을 쉽니다.";
//     }

//     public function printInfo() {
//         return $this->name."는 ".$this->age."살 입니다."; // $this는 Whale의 영역을 가리킴
//     }

//     // getter(해당 프로퍼티 가져오기) / setter(해당 프로퍼티 변경) 메소드
//     // 캡슐화 때문에 private으로 프로퍼티 생성함
//     // 해당 프로퍼티를 변경할 경우가 생길 수 있음 -> 우회해서 접근하기 위해 getter, setter 이용
//     public function getAge() { // getter는 get+프로퍼티명
//         return $this->age;
//     }
//     public function setAge($age) { // setter는 set+프로퍼티명, $age->외부에서 넘겨받은 파라미터
//         $this->age = $age;
//     }

//     // static method
//     // instance화 하지 않고 접근, 호출 가능
//     // static을 하면 메모리상에 모두 등록되어있음
//     // 전부 static으로 만들면 -> 하드웨어 리소스 낭비 -> 속도가 느려짐
//     // 여기저기서 자주 사용될 법한 것만 static으로 만들어 사용하기 쉽도록, 꼭 필요한 것만!
//     // class내부의 프로퍼티 사용하는 등의 처리는 할 수 없음 -> static method만 메모리에 저장됨
//     // static method만 메모리에 저장됨
//     public static function dance() {
//         return '고래가 춤을 춥니다.';
//         // return $this->name; // 접근 불가
//     }
// }

// echo Whale::dance(); // static 메소드는 '::' 필요

// // // Whale Instance -> 메모리상에 새로 올린다
// // $whale = new Whale(); // () -> 함수나 메소드 실행한다는 뜻, 여기서는 construct 실행한다는 뜻
// $whale = new Whale('핑크고래', 40);
// echo $whale->printInfo();
// $whale2 = new Whale(); // 또다른 Whale()
// // 서로 다른 객체 하나씩 가짐

// echo $whale->name;
// // echo $whale->age; // 에러
// echo $whale->printInfo();

// echo $whale->getAge();
// $whale->setAge(30);
// echo $whale->getAge();

// $whale->setAge(30);
// echo $whale->getAge(); // 30 출력됨
// echo $whale2->getAge(); // 20 출력됨