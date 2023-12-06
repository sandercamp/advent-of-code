<?php

function parseInput(): array {
    $lines = file('src/2023/6/test.txt');

    $times = parseIntegers($lines[0]);
    $distances = parseIntegers($lines[1]);



    return [$times, $distances];
}

function parseInputTwo(): array {
    $lines = file('src/2023/6/input.txt');

    $time = implode(parseIntegers($lines[0]));
    $distance = implode(parseIntegers($lines[1]));

    return [[$time], [$distance]];
}

function parseIntegers(string $string): array {
    preg_match_all('!\d+!', $string, $matches);

    return $matches[0] ?? [];
}