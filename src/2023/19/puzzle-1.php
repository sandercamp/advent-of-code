<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        [$workflows, $parts] = parseInput();

        $result = 0;
        foreach ($parts as $part) {
            if (processPartOne($part, $workflows, 'in')) {
                foreach ($part as [$min, $max]) {
                    $result += $min;
                }
            }
        }

        echo "Result: {$result}\n"; // Test: 19114 | Input: 532551
    }
);
