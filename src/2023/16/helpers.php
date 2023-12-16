<?php

function parseInput(): array {
    $lines = file('test.txt');

    $map = '';
    $l = 0;
    $tileCount = 0;
    foreach ($lines as $line) {
        $map .= $trimmed = trim($line);
        $l = strlen($trimmed);
        $tileCount += $l;
    }

    $tiles = array_fill(0, $tileCount, 0);

    // Negative is l => r and u => d
    $directionMap = [
        '/' => [-$l => -1, $l => 1, -1 => -$l, 1 => $l],
        '\\' => [-$l => 1, 1 => -$l, -1 => $l, $l => -1],
        '|' => [-$l => $l, $l => -$l],
        '-' => [-1 => 1, 1 => -1],
    ];

    return [$map, $directionMap, $l, $tiles];
}


function drawLoop(string $map, array $directions): array {
    $start = strpos($map, 'S');

    // Dirty: only works on test and puzzle input data
    $current = $start + 1;
    $steps = [$start];
    $previous = $start;
    while(true) {
        $steps[] = $current;
        $next = $current + $directions[getPipe($map, $current)][$previous - $current];

        if ($next === $start) {
            break;
        }

        $previous = $current;
        $current = $next;
    }

    return $steps;
}