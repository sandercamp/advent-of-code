<?php

require_once('parse-input.php');

$parsedInput = parseInput();

$result = 0;
foreach ($parsedInput as $game) {
    $green = array_column($game, 'green');
    $red = array_column($game, 'red');
    $blue = array_column($game, 'blue');
    rsort($green);
    rsort($red);
    rsort($blue);

    $result += reset($red) * reset($green) * reset($blue);
}

var_dump($result); // 63307
