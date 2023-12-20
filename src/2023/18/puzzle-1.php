<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        $instructions = parseInput();

        $directionMap = [
            'R' => [1, 0],
            'D' => [0, 1],
            'L' => [-1, 0],
            'U' => [0, -1],
        ];

        $a = 0;
        $b = 0;
        $pos = 0;
        foreach ($instructions as [$direction, $steps]) {
            [$x, $y] = $directionMap[$direction];

            $b += $steps;
            $pos += $x * $steps;
            $a += $y * $pos * $steps;
        }

        $result = $a + ($b / 2) + 1;

        echo "Result: {$result}\n"; // Test: 62 | Input: 44436
    }
);
