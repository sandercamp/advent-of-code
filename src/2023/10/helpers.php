<?php

function parseInput(): array {
    $lines = file('input.txt');

    $loopMap = '';
    $l = 0;
    foreach ($lines as $line) {
        $loopMap .= $trimmed = trim($line);
        $l = strlen($trimmed);
    }

    $directionMap = [
        '|' => [-$l => $l, $l => -$l],
        '-' => [-1 => 1, 1 => -1],
        'L' => [-$l => 1, 1 => -$l],
        'J' => [-1 => -$l, -$l => -1],
        '7' => [-1 => $l, $l => -1],
        'F' => [$l => 1, 1 => $l]
    ];

    return [$loopMap, $directionMap, $l];
}

function getPipe(string $map, int $offset): ?string
{
    if ($offset < 0) {
        return null;
    }

    return substr($map, $offset, 1);
}

function drawBeam(string $map, array $directions): array {
    $start = $current = 0;
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