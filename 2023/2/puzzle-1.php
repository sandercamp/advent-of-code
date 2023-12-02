<?php

require_once('parse_input.php');

$parsedInput = parseInput();

$maxRed = 12;
$maxGreen = 13;
$maxBlue = 14;

$count = function (int $max, array $set) {
    return count(array_filter($set, fn($i) => $i > $max)) === 0;
};

$result = 0;
foreach ($parsedInput as $id => $game) {
    $greenValid = $count($maxGreen, array_column($game, 'green'));
    $redValid = $count($maxRed, array_column($game, 'red'));
    $blueValid = $count($maxBlue, array_column($game, 'blue'));

    if ($greenValid && $blueValid && $redValid) {
        $result += $id;
    }
}

var_dump($result); // 2416

