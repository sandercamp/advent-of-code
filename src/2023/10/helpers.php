<?php

function parseInput(): array {
    $lines = file('input.txt');

    $loopMap = '';
    $l = 0;
    foreach ($lines as $line) {
        $trimmed = trim($line);
        $l = strlen($trimmed);

        $loopMap .= trim($trimmed);
    }

    $directionMap = [
        '|' => [-$l => $l, $l => -$l],
        '-' => [-1 => 1, 1 => -1],
        'L' => [-$l => 1, 1 => -$l],
        'J' => [-1 => -$l, -$l => -1],
        '7' => [-1 => $l, $l => -1],
        'F' => [$l => 1, 1 => $l]
    ];

    return [$loopMap, $directionMap];
}

function getPipe(string $map, int $offset): ?string
{
    if ($offset < 0) {
        return null;
    }

    return substr($map, $offset, 1);
}