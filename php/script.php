<?php
$x = $_GET['x'];
$y = $_GET['y'];
$r = $_GET['r'];
$time_offset = $_GET['time'];
$startTime = microtime(true);
$ans_count = count($r);


function validate($x, $y, $r){
    if (validate_x($x) && validate_y($y) && validate_r($r)){
        return true;
    }
    return false;
}

function validate_x($x){
    if ($x == -5 || $x == -4 || $x == -3 || $x == -2 || $x == -1 || $x == 0 || $x == 1 || $x == 2 || $x == 3){
        return true;
    }
    return false;
}

function validate_y($y){
    if ($y > -5 && $y < 5){
        return true;
    }
    return false;
}

function validate_r($r){
    foreach ($r as $value){
        if (!($value == 1 || $value == 1.5 || $value == 2 || $value == 2.5 || $value == 3)){
            return false;
        }
    }
    return true;
}

function check_rectangle($x, $y, $r){
    if ($x <= 0 && $y <= 0 && ($x >= (-1 * $r)) && ($y >= ($r / 2))){
        return true;
    }
    return false;
}

function check_triangle($x, $y, $r){
    if ($x >= 0 && $y <= 0 && ($x - $y <= ($r / 2))){
        return true;
    }
    return false;
}

function check_circle($x, $y, $r){
    if ($x <= 0 && $y >= 0 && ($x * $x + $y * $y <= ($r * $r / 4))){
        return true;
    }
    return false;
}

function check_zero($x, $y, $r){
    if ($x == 0 && $y == 0){
        return true;
    }
    return false;
}

function check_hit($x, $y, $r){
    if (check_rectangle($x, $y, $r) || check_triangle($x, $y, $r) || check_circle($x, $y, $r) || check_zero($x, $y, $r)){
        return true;
    }
    return false;
}

header('HTTP/1.1 400 Bad Request
        Host: localhost:3000
        Connection: close
        Content-type: text/html; charset=UTF-8');

if (validate($x, $y, $r)){
    $ans = [];

    for($i = 0; $i < $ans_count; $i++){
        if (check_hit($x, $y, $r[$i])){
            $result = "Kill";
        }
        else{
            $result = "Miss";
        }

        $time_of_work = microtime(true) - $startTime;
        $currentTime = date("H:i:s", time() - $time_offset * 60);
        if ($time_offset > 0){
            $timezone = "(GMT " . $time_offset / 60 . ")";
        }else{
            $timezone = "(GMT +" . $time_offset / -60 . ")";
        }
        $try = [$x, $y, $r[$i], $result, round($time_of_work, 6), $timezone . $currentTime];
        array_push($ans, $try);
    }

    print_r(json_encode($ans));
}
else{
    http_response_code(400);
    if (!validate_x($x)){
        echo "Invalid x";
    }
    if (!validate_y($y)){
        echo "Invalid y";
    }
    if (!validate_r($r)){
        echo "Invalid r";
    }
}

