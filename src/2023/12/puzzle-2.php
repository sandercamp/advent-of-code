<?php

require_once('../../util.php');
require_once('helpers.php');

ini_set('memory_limit', '2G');

run(
    function() {
        global $cache;
        $input = parseInputAndUnfold();

        $result = 0;
        foreach ($input as [$springs, $groups]) {
            $permutations = generatePermutations($springs, $groups);
            $filtered = array_unique(array_filter($permutations, fn(string $string) => matchesGroups($string, $groups)));

            $result += count($filtered);
        }

        var_dump(count($cache));

        echo "Result: {$result}\n"; // Test: 21 | Input: 8193
    }
);
