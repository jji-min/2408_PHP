<?php
// class : 동종의 객체들을 모아 정의한 것
// 관습적으로 파일명과 클래스명을 동일하게(대소문자까지 똑같이) 지어줌(에러는 발생하지 않지만...)
// 클래스마다 파일 생성해야 함
class Whale {
    // ----------------
    // 프로퍼티
    // ----------------
    // 접근 제어 지시자
    // public : Class 내/외부 어디에서나 접근 가능
    public $name = "고래";   // Class 내에서 만들어준 변수를 프로퍼티라고 함
    // private : Class 내부에서만 접근 가능
    private $age = 30;
    // protected : Class 내부 및 상속관계에서 접근 가능(외부 접근 불가)
    protected $gender;

    // ----------------
    // 메소드(method)
    // ----------------
    // 메소드는 기본적으로 public
    function breath() {
        echo "숨을 쉽니다.";
    }
    // Class에 속해 있는 각각을 모두 멤버라고 함

    function info() {
        // $this : Class 내의 프로퍼티나 메소드에 접근하기 위해 사용, 자기 자신을 가리킴(Class Whale을 가리킴)
        echo "나이는".$this->age;
    }

    // function info() {
    //     echo "나이는".$this->breath();
    //     // "숨을 쉽니다.나이는"이 출력됨
    //     // breath 메소드가 호출 -> "나이는"이 출력되고 -> $this->breath()는 return값이 없으니까 출력안됨
    // }

    // static 메소드
    // 이미 메모리상에 올라가 있음
    // 꼭 필요한 곳에만 static 지정, 필요없는 것까지 메모리에 올리지 않음
    public static function myStatic() {
        echo "스테틱 메소드";
    }
}