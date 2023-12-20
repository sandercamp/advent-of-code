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

        $x1 = 0;
        $y1 = 0;
        $a = 0;
        $b = 0;
        foreach ($instructions as [$direction, $steps]) {
            [$x2, $y2] = $directionMap[$direction];

            $b += $steps;

            $x2 = $x1 + ($x2 * $steps);
            $y2 = $y1 + ($y2 * $steps);

            $a += ($x1 * $y2) - ($x2 * $y1);

            $x1 = $x2;
            $y1 = $y2;
        }

        $result = ($a / 2) + ($b / 2) + 1;

        echo "Result: {$result}\n"; // Test: 62 | Input: 44436
    }
);
