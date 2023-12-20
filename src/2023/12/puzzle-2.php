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

        global $cache;
        //var_dump(count($cache));
        //var_dump($cache);

        echo "Result: {$result}\n"; // Test: 525152 | Input: 8193
    }
);
