<?php

require_once('src/util.php');
require_once('helpers.php');

run(
    function() {
        $lines = parseInput();
        $symbolMatcher = fn(string $char): bool => $char === '*';
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
                    if (array_intersect($matches, $keys)) {
                        $productNumbers[] = $number;
                    }

                    if (count($productNumbers) > 2) {
                        break;
                    }
                }

                if (count($productNumbers) === 2) {
                    $result += array_product($productNumbers);
                }
            }
        }

        var_dump($result === 79844424);

//var_dump($result); // 79844424
    }
);