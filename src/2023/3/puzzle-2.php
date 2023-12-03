<?php

require_once('helpers.php');

$lines = parseInput();
$symbolMatcher = fn($char) => $char === '*';
$result = 0;
foreach ($lines as $lineNumber => $line) {
    $symbols = findMatches($line, $symbolMatcher);
    foreach ($symbols as $symbol) {
        $matches = [$symbol, $symbol - 1, $symbol + 1];
        $productNumbers = [];
        // TODO: The same lines are parsed twice
        $numberMaps = array_merge(
            findNumbers($line) ?? [],
            findNumbers($lines[$lineNumber - 1]) ?? [],
            findNumbers($lines[$lineNumber + 1]) ?? [],
        );

        foreach ($numberMaps as ['number' => $number, 'keys' => $keys]) {
            if (count($productNumbers) > 2) {
                break;
            }

            if (array_intersect($matches, $keys)) {
                $productNumbers[] = $number;
            }
        }

        if (count($productNumbers) === 2) {
            $result += array_product($productNumbers);
        }
    }
}

var_dump($result === 79844424);

//var_dump($result); // 79844424