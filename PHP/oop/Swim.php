<?php
namespace PHP\oop;

interface Swim {
    // 추상메소드만 가질 수 있음
    // 인터페이스는 추상메소드만 가질 수 있기 때문에 abstract 안적어도됨, 그자체로도 추상적인 존재여서
    // 인터페이스는 '이게 있어야 한다'는 강제성만 줌
    public function swimming();
}