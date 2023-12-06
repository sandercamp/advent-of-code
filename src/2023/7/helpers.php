<?php

function parseInput(): array {
    $lines = file('src/2023/6/input.txt');

}

function parseIntegers(string $string): array {
    preg_match_all('!\d+!', $string, $matches);

    return $matches[0] ?? [];
}