<?php

require_once('src/util.php');
require_once('helpers.php');

run(
    function() {
        [$instructions, $parsedMaps] = parseInput();

        $steps = 0;
        $current = 'VGA';
        while(true) {
            foreach ($instructions as $instruction) {
                $steps++;
                $current = $parsedMaps[$current][$instruction];
                if (endsWithZ($current)) {
                    break 2;
                }
            }
        }

        var_dump($current);
        var_dump($parsedMaps[$current]);

        echo "Result: {$steps}\n"; // Test:  6 | Input: 11567
    }
);
