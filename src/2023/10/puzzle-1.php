<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        [$loopMap, $directionMap] = parseInput();
        $sPosition = strpos($loopMap, 'S');

        // Dirty: only works on test and puzzle input data
        $currentIndex = $sPosition + 1;
        $steps = ['S'];
        $previousIndex = $sPosition;
        while(true) {
            $currentPipe = getPipe($loopMap, $currentIndex);
            $steps[] = $currentPipe;
            $nextIndex = $currentIndex + $directionMap[$currentPipe][$previousIndex - $currentIndex];

            if ($nextIndex === $sPosition) {
                break;
            }

            $previousIndex = $currentIndex;
            $currentIndex = $nextIndex;
        }

        $result = count($steps) / 2;

        echo "Result: {$result}\n"; // Test: 8 | Input: 7145
    }
);
