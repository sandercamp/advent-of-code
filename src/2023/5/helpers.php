<?php

function parseInput(): array {
    $input = preg_split("#\n\s*\n#Uis", file_get_contents('src/2023/5/test.txt'));

    $seeds = parseIntegers(array_shift($input));

    $categories = [
        'seed-to-soil',
        'soil-to-fertilizer',
        'fertilizer-to-water',
        'water-to-light',
        'light-to-temperature',
        'temperature-to-humidity',
        'humidity-to-location'
    ];

    $maps = ['seeds' => $seeds];
    foreach ($categories as $index => $category) {
        $maps[$category] = array_chunk(parseIntegers($input[$index]), 3);
    }

    return $maps;
}

function parseInputTwo(): array {
    $input = preg_split("#\n\s*\n#Uis", file_get_contents('src/2023/5/input.txt'));

    $seedRanges = array_chunk(parseIntegers(array_shift($input)), 2);

    $categories = [
        'seed-to-soil',
        'soil-to-fertilizer',
        'fertilizer-to-water',
        'water-to-light',
        'light-to-temperature',
        'temperature-to-humidity',
        'humidity-to-location'
    ];

    $maps = ['seedRanges' => $seedRanges];
    foreach ($categories as $index => $category) {
        $maps[$category] = array_chunk(parseIntegers($input[$index]), 3);
    }

    return array_reverse($maps);
}

function parseIntegers(string $string): array {
    preg_match_all('!\d+!', $string, $matches);

    return $matches[0] ?? [];
}

function binarySearch(int $low, int $high, int $case): int {
    while ($low <= $high) {
        $mid = floor(($low + $high) / 2);
        if ($case < $mid) {
            $high = $mid - 1;
        } else {
            $low = $mid + 1;
        }
    }

    return $high;
}
