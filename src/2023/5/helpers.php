<?php

function parseInput(): array {
    $input = preg_split("#\n\s*\n#Uis", file_get_contents('src/2023/5/input.txt'));

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

function parseIntegers(string $string): array {
    preg_match_all('!\d+!', $string, $matches);

    return $matches[0] ?? [];
}

function binarySearch(int $low, int $high, int $case): int {
    while ($low <= $high) {

        $mid = floor(($low + $high) / 2);

        // element found at mid

        if ($case < $mid) {
            // search the left side of the array
            $high = $mid - 1;
        } else {
            // search the right side of the array
            $low = $mid + 1;
        }
    }

    return $high;
}
