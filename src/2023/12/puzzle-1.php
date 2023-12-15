<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        $input = parseInput();

        $result = 0;
        foreach ($input as [$springs, $groups]) {
            $permutations = generatePermutations($springs);
            $filtered = array_unique(array_filter($permutations, fn(string $string) => matchesGroups($string, $groups)));

            $result += count($filtered);
        }

        echo "Result: {$result}\n"; // Test: 21 | Input: 8193
    }
);
