<?php

const RIGHT = 'right';
const LEFT = 'left';
const UP = 'up';
const DOWN = 'down';
const SPLIT_UP_DOWN = 'ud';
const SPLIT_LEFT_RIGHT = 'lr';

function parseInput(): array {
    $lines = file('input.txt');
    $map = [];
    foreach ($lines as $line) {
        $map[] = str_split(trim($line));
    }

    $directions = [
        '/' => [LEFT => DOWN, RIGHT => UP, UP => RIGHT, DOWN => LEFT],
        '\\' => [LEFT => UP, RIGHT => DOWN, UP => LEFT, DOWN => RIGHT],
        '|' => [UP => UP, DOWN => DOWN, LEFT => SPLIT_UP_DOWN, RIGHT => SPLIT_UP_DOWN],
        '-' => [LEFT => LEFT, RIGHT => RIGHT, UP => SPLIT_LEFT_RIGHT, DOWN => SPLIT_LEFT_RIGHT],
        '.' => [LEFT => LEFT, RIGHT => RIGHT, UP => UP, DOWN => DOWN]
    ];

    return [$map, $directions];
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