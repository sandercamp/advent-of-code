<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        [$workflows, $parts] = parseInput();

        $result = 0;
        foreach ($parts as $part) {
            if (processPart($part, $workflows, 'in')) {
                $result += array_sum($part);
            }
        }

        echo "Result: {$result}\n"; // Test: 19114 | Input: 532551
    }
);
