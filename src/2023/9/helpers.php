<?php

function parseInput(bool $reverse = false): array {
    $lines = file('input.txt');

    $parsedInput = [];
    foreach ($lines as $line) {
        $parsedLine = explode(" ", $line);
        $parsedInput[] = $reverse ? array_reverse($parsedLine) : $parsedLine;
    }

    return $parsedInput;
}

function sumExtrapolation(array $sequences): int {
    return array_reduce(
        $sequences,
        fn(int $carry, array $sequence) => $carry + end($sequence) + extrapolate($sequence),
        0
    );
}

function extrapolate(array $sequence) {
    $diffSequence = [];
    for ($i = 0; $i < count($sequence) - 1; $i++) {
        $diffSequence[] = $sequence[$i + 1] - $sequence[$i];
    }

    return (count(array_diff($diffSequence, [0])) ? extrapolate($diffSequence) : 0) + end($diffSequence);
}
