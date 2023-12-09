<?php

function parseInput(): array {
    $lines = file('input.txt');

    $parsedInput = [];
    foreach ($lines as $line) {
        $parsedInput[] = explode(" ", $line);
    }

    return $parsedInput;
}

function parseInputTwo(): array {
    $lines = file('input.txt');

    $parsedInput = [];
    foreach ($lines as $line) {
        $parsedInput[] = array_reverse(explode(" ", $line));
    }

    return $parsedInput;
}

function parseIntegers(string $string): array {
    preg_match_all('!\d+!', $string, $matches);

    return $matches[0] ?? [];
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
    foreach ($sequence as $i => $current) {
        if (isset($sequence[$i + 1])) {
            $diffSequence[] = $sequence[$i + 1] - $current;
        }
    }

    $result = count(array_diff($diffSequence, [0])) ? extrapolate($diffSequence) : 0;

    return $result + end($diffSequence);
}
