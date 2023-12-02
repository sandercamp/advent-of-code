<?php

require_once('parse-input.php');

$parsedInput = parseInput();

$colors = ['green' => 13, 'red' => 12, 'blue' => 14];
$result = 0;
foreach ($parsedInput as $id => $game) {
    foreach ($colors as $color => $max) {
        if (count(array_filter(array_column($game, $color), fn($i) => $i > $max)) !== 0) {
            continue 2;
        }
    }

    $result += $id;
}

var_dump($result); // 2416
