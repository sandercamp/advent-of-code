<?php

require_once('helpers.php');

$lines = parseInput();
$result = [];
$numberMaps = [];
$symbols = [];
$symbolMatcher = fn(string $char): bool => !in_array($char, [...range(0, 9), '.']);
foreach ($lines as $lineNumber => $line) {
    $numberMaps[$lineNumber] = findNumbers($line);
    $symbols[$lineNumber] = findMatches($line, $symbolMatcher);
}

foreach ($numberMaps as $lineNumber => $maps) {
    $matchingIndices = array_merge(
    $symbols[$lineNumber] ?? [],
        $symbols[$lineNumber - 1] ?? [],
        $symbols[$lineNumber + 1] ?? []
    );

    foreach ($maps as ['number' => $number, 'keys' => $keys]) {
        if (array_intersect([min($keys) - 1, max($keys) + 1, ...$keys], $matchingIndices)) {
            $result[] = $number;
        }
    }
}

//var_dump(array_sum($result) === 535235);
var_dump(array_sum($result)); // 535235
