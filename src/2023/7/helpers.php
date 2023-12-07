<?php

function parseInput(): array {
    $lines = file('src/2023/7/input.txt');

    $parsedInput = [];
    foreach ($lines as $line) {
        [$hand, $bid] = explode(' ', trim($line));
        $parsedInput[] = [$hand, determineType($hand), $bid];
    }

    return $parsedInput;
}

function parseInputTwo(): array {
    $lines = file('src/2023/7/input.txt');

    $parsedInput = [];
    foreach ($lines as $line) {
        [$hand, $bid] = explode(' ', trim($line));
        $parsedInput[] = [$hand, determineTypeTwo($hand), $bid];
    }

    return $parsedInput;
}

function determineType(string $hand): int {
    $countValues = array_count_values(str_split($hand));
    $uniqueCount = count($countValues);

    arsort($countValues);

    if ($uniqueCount === 1) {
        return 7; // Five of a kind
    }

    if ($uniqueCount === 2) {
        // Four of a kind or full house
        if (array_shift($countValues) === 4) {
            return 6;
        }

        return 5;
    }

    if ($uniqueCount === 3) {
        // Three of a kind or two pairs
        if (array_shift($countValues) === 3) {
            return 4;
        }

        return 3;
    }

    if ($uniqueCount === 4) {
        return 2;
    }

    return 1;
}

function determineTypeTwo(string $hand): int {
    $countValues = array_count_values(str_split($hand));
    $uniqueCount = count($countValues);

    arsort($countValues);

    $jokers = 0;
    if (isset($countValues['J'])) {
        $jokers = $countValues['J'];
        unset($countValues['J']);
        $uniqueCount = count($countValues);
    }

    if ($uniqueCount === 1 || $jokers === 5 ) {
        return 7; // Five of a kind
    }

    if ($uniqueCount === 2) {
        // Four of a kind or full house
        if (array_shift($countValues) + $jokers > 3) {
            return 6;
        }

        return 5;
    }

    if ($uniqueCount === 3) {
        // Three of a kind or two pairs
        if (array_shift($countValues) + $jokers > 2) {
            return 4;
        }

        return 3;
    }

    // One pair
    if (array_shift($countValues) + $jokers > 1) {
        return 2;
    }

    return 1;
}

function compareHands(array $a, array $b): int {
    [$aHand, $aType] = $a;
    [$bHand, $bType] = $b;

    if ($aType === $bType) {
        $aChars = str_split($aHand);
        $bChars = str_split($bHand);
        foreach ($aChars as $i => $aChar) {
            $comparison = compareChars($aChar, $bChars[$i]);
            if ($comparison !== 0) {
                return $comparison;
            }
        }

        return 0;
    }

    return $aType < $bType ? -1 : 1;
}

function compareChars($a, $b): int {
    $map = [
        'A' => 14,
        'K' => 13,
        'Q' => 12,
        //'J' => 11, // Part one
        'T' => 10,
        9 => 9,
        8 => 8,
        7 => 7,
        6 => 6,
        5 => 5,
        4 => 4,
        3 => 3,
        2 => 2,
        'J' => 1, // Part two
    ];

    return $map[$a] <=> $map[$b];
}