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

function parseInput2b(): array {
    $input = preg_split("#\n\s*\n#Uis", file_get_contents('src/2023/5/test.txt'));
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

    foreach ($categories as $index => $category) {
        $maps[$category] = array_chunk(parseIntegers($input[$index]), 3);
    }

    $reversed = array_reverse($maps);
    $maxLocation = null;
    $optimized = [];
    $idealSourceRanges = null;
    foreach ($reversed as $category => $cMaps) {
        $max = null;
        $newIRanges = [];
        foreach ($cMaps as $key => [$destination, $source, $length]) {
            if ($idealSourceRanges !== null) {
                foreach ($idealSourceRanges as [$iDest, $iLength]) {
                    $y1 = $iDest;
                    $y2 = $iDest + $iLength;

                    $x1 = $destination;
                    $x2 = $destination + $length;

                    if ($x1 <= $y2 && $y1 <= $x2) {
                        $optimized[$category][$key] = $cMaps[$key];
                        $newIRanges[] = [$source, $length];
                    }
                }
            } else {
                $a = $destination + $length;
                if ($max === null || $max < $maxLocation) {
                    $max = $a;
                    $optimized[$category] = $maps[$category][$key];
                    $idealSourceRanges[] = [$source, $length];
                }

                continue 2;
            }

        }

        if (count($newIRanges) > 0) {
            $idealSourceRanges = $newIRanges;
        }

        if (!isset($optimized[$category])) {
            $optimized[$category] = [];
        }
    }

    foreach ($seedRanges as $index => [$start, $length]) {
        $found = false;
        foreach ($optimized['seed-to-soil'] as [$destination, $source, $j]) {
            $y1 = $source;
            $y2 = $source + $j;

            $x1 = $start;
            $x2 = $start + $length;

            if ($x1 <= $y2 && $y1 <= $x2) {
                $found = true;
                break;
            }
        }

        if (!$found) {
            unset($seedRanges[$index]);
        }
    }

    array_unshift($maps, $seedRanges);

    return $maps;
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
