<?php 

function print_stars($item) {
    $str_star = "";
    for($i = 1; $i <= (int)floor($item["rating"] / 2); $i++) {
        $str_star .= '<i class="fa-solid fa-star star"></i> ';
    } 
    if($item["rating"] % 2) {
        $str_star .= '<i class="fa-regular fa-star-half-stroke star"></i> ';
    } 
    $cnt = (int)floor($item["rating"] / 2);
    if($item["rating"] % 2) { $cnt++; }
    $cnt = 5 - $cnt;
    for($i = 1; $i <= $cnt; $i++) {
        $str_star .= '<i class="fa-regular fa-star star"></i> ';
    }
    return $str_star;
} 