<?php

function parseInput(): array {
    $lines = file('src/2023/4/input.txt');

    $parsedInput = [];
    foreach ($lines as $line) {
        [$identifier, $numbers] = explode(':', $line);
        [$drawnNumbers, $winningNumbers] = explode('|', $numbers);

        $parsedInput[filter_var($identifier, FILTER_SANITIZE_NUMBER_INT)] = [
            array_filter(explode(' ', trim($drawnNumbers))),
            array_filter(explode(' ', trim($winningNumbers)))
        ];
    }

    return $parsedInput;
}

function doubleConsecutive(int $n): int {
    return $n === 0
        ? 0
        : array_reduce(
            array_fill(0, $n - 1, null),
            fn(int $carry) => $carry * 2,
            1
        );
}

function countCards(array $matches, int $matchId): int {
    $result = count($matches[$matchId]);

    foreach ($matches[$matchId] as $key) {
        $result += countCards($matches, $key);
    }

    return $result;
}
