<?php

require_once('helpers.php');

$lines = parseInput();

$allSymbols = [];

$symbolMatcher = fn($char) => $char === '*';

foreach ($lines as $lineNumber => $line) {
    $allSymbols[$lineNumber] = findMatches($line, $symbolMatcher);
}

$result = 0;
foreach ($allSymbols as $lineNumber => $lineSymbols) {
    foreach ($lineSymbols as $symbol) {
        $matches = [$symbol, $symbol - 1, $symbol + 1];

        $productNumbers = [];
        // Current line
        $numberMaps = findNumbers($lines[$lineNumber]);

        foreach ($numberMaps as $numberMap) {
            ['number' => $number, 'keys' => $keys] = $numberMap;

            if (array_intersect($matches, $keys)) {
                $productNumbers[] = $number;
            }
        }

        // Previous line
        if (isset($lines[$lineNumber -1])) {
            $numberMaps = findNumbers($lines[$lineNumber -1]);

            foreach ($numberMaps as $numberMap) {
                $number = $numberMap['number'];
                $keys = $numberMap['keys'];
                if (array_intersect($matches, $keys)) {
                    $productNumbers[] = $number;
                }
            }
        }

        // Next line
        if (isset($lines[$lineNumber + 1])) {
            $numberMaps = findNumbers($lines[$lineNumber + 1]);

            foreach ($numberMaps as $numberMap) {
                $number = $numberMap['number'];
                $keys = $numberMap['keys'];
                if (array_intersect($matches, $keys)) {
                    $productNumbers[] = $number;
                }
            }
        }

        if (count($productNumbers) === 2) {
            $result += array_product($productNumbers);
        }
    }
}

//var_dump($result === 79844424);

var_dump($result); // 79844424