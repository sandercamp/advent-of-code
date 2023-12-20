<?php

function parseInput(): array {
    $lines = file('input.txt');

    $parsedInput = [];
    foreach ($lines as $line) {
        [$direction, $steps, $color] = explode(' ', trim($line));

        $parsedInput[] = [$direction, (int)$steps, $color];
    }

    return $parsedInput;
}

function parseInput2(): array {
    $lines = file('input.txt');

    $parsedInput = [];
    $bounds = 0;
    foreach ($lines as $line) {
        [$_, $_, $color] = explode(' ', trim($line));

        $hex = trim(trim($color, '(#'), ')');
        $directionMap = ['R', 'D', 'L', 'U'];
        $direction = $directionMap[$hex[-1]];
        $steps = hexdec(substr($hex, 0, strlen($hex) - 1));

        $parsedInput[] = [$direction, (int)$steps];
    }

    return $parsedInput;
}
