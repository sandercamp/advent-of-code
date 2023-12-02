<?php

require_once('parse-input.php');

$parsedInput = parseInput();

$result = 0;
$colors = ['green', 'red', 'blue'];
foreach ($parsedInput as $game) {
    $result += array_product(array_map(fn ($color) => max(array_column($game, $color)), $colors));
}

var_dump($result); // 63307
