<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        $input = parseInput();

        $result = 0;
        foreach ($input as [$springs, $groups, $brokenSprings]) {
            $positions = [];

            $pos = 0;
            while (($pos = strpos($springs, '?', $pos)) !== false) {
                $positions[] = $pos;
                $pos++;
            }

            $strings = array_filter(
                generate($springs, ['.', '#'], $positions),
                function(string $string) use ($groups) {
                    $parts = array_filter(explode('.', $string));

                    $sum = array_values(array_map(fn(string $part) => substr_count($part, '#'), $parts));

                    return strpos($string, '?') === false && $sum == $groups;
                }
            );

            var_dump($strings);

            $result += count($strings);
        }

        echo "Result: {$result}\n"; // Test: 20 | Input: ?
    }
);
