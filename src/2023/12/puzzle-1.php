<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        $input = parseInput();

        $result = 0;
        foreach ($input as [$springs, $groups]) {
            $result += calculatePermutations($springs, $groups);
        }

        echo "Result: {$result}\n"; // Test: 21 | Input: 8193
    }
);
