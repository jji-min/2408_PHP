<?php
require_once('./Whale.php');
require_once('./FlyingSquirrel.php');
require_once('./GoldFish.php');

use PHP\oop\Whale;
use PHP\oop\FlyingSquirrel;
use PHP\oop\GoldFish;

$whale = new Whale('고래', '바다');
echo $whale->printInfo();

$flyingSquirrel = new FlyingSquirrel('날다람쥐', '산');
echo $flyingSquirrel->printInfo();
// construct가 없으면 default construct가 실행됨
// 상속받고 있는 부모에 construct가 있으면 부모의 construct가 실행됨 -> 상속

$goldFish = new GoldFish();
echo $goldFish->printPet();