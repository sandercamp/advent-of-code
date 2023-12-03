<?php

function parseInput(): array {
    return file('src/2023/3/input.txt');
}

function findNumbers(string $line): array {
    $numbers = [];
    $rawDigits = array_filter(str_split($line), fn($char) => is_numeric($char));

    foreach ($rawDigits as $key => $rawDigit) {
        if (isset($numbers[$key - 1])) {
            $numbers[$key]['keys'][] = $key;
            $numbers[$key]['number'] = "{$numbers[$key-1]['number']}{$rawDigit}";

            $numbers[$key] = [
                'number' => (int)"{$numbers[$key-1]['number']}{$rawDigit}",
                'keys' => [...$numbers[$key-1]['keys'], $key]
            ];

            unset($numbers[$key - 1]);
        } else {
            $numbers[$key] = [
                'number' => $rawDigit,
                'keys' => [$key]
            ];
        }
    }

    return $numbers;
}

function findMatches(string $string, callable $condition): array {
    $matches = array_filter(str_split($string), $condition);
    // TODO: This additional filtering should not be necessary
    return array_keys(array_filter($matches, fn($match) => strlen(trim($match))));
}
