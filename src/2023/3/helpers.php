<?php

function parseInput(): array {
    return file('src/2023/3/input.txt');
}

function findNumbers(string $line): array {
    $numbers = [];
    $rawDigits = array_filter(str_split($line), fn($char) => is_numeric($char));
    foreach ($rawDigits as $key => $rawDigit) {
        $previous = $key - 1;
        $isAddition = isset($numbers[$previous]);

        $numbers[$key] = [
            'number' => $isAddition ? (int)"{$numbers[$previous]['number']}{$rawDigit}" : $rawDigit,
            'keys' => $isAddition ? [...$numbers[$previous]['keys'], $key] : [$key]
        ];

        unset($numbers[$previous]);
    }

    return $numbers;
}

function findMatches(string $string, callable $condition): array {
    $matches = array_filter(str_split($string), $condition);
    // TODO: This additional filtering should not be necessary
    return array_keys(array_filter($matches, fn($match) => strlen(trim($match))));
}
