<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        [$instructions, $parsedMaps, $startingNodes] = parseInput();
        $countToZ = [];
        foreach ($startingNodes as $node) {
            $steps = 0;
            $current = $node;

            while(true) {
                foreach ($instructions as $instruction) {
                    $steps++;
                    $current = $parsedMaps[$current][$instruction];

                    if (str_ends_with($current, 'Z')) {
                        $countToZ[$node] = $steps;
                        break 2;
                    }
                }
            }
        }

        $result = array_reduce(
            $countToZ,
            fn (GMP $carry, int $count) => gmp_lcm($carry, $count),
            gmp_init(1)
        );

        echo "Result: {$result}\n"; // Test: 6 | Input: 9858474970153
    }
);
