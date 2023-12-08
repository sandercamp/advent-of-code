<?php

require_once('src/util.php');
require_once('helpers.php');

run(
    function() {
        [$instructions, $parsedMaps] = parseInput();

        $steps = 0;
        $current = 'AAA';
        while(true) {
            foreach ($instructions as $instruction) {
                $steps++;
                $current = $parsedMaps[$current][$instruction];
                if ($current === 'ZZZ') {
                    break 2;
                }
            }
        }

        echo "Result: {$steps}\n"; // Test:  6 | Input: 11567
    }
);
