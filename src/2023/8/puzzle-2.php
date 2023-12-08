<?php

require_once('src/util.php');
require_once('helpers.php');

run(
    function() {
        [$instructions, $parsedMaps, $startingNodes] = parseInput();
        $countToZ = [];
        foreach ($startingNodes as $node) {
            $steps = 0;
            $current = $node;

            if (endsWithZ($current)) {
                $countToZ[$node] = $steps;
                continue;
            }

            while(true) {
                foreach ($instructions as $instruction) {
                    $steps++;
                    $current = $parsedMaps[$current][$instruction];

                    if (endsWithZ($current)) {
                        $countToZ[$node] = $steps;
                        break 2;
                    }
                }
            }
        }

        $result = 1;
        foreach ($countToZ as $c) {
            $result = gmp_lcm($result, $c);
        }

        echo "Result: {$result}\n"; // Test: 6 | Input: 9858474970153
    }
);
