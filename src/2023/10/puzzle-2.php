<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        [$loopMap, $directionMap] = parseInput();
        $sPosition = strpos($loopMap, 'S');

        // Dirty: only works on test and puzzle input data
        $currentIndex = $sPosition + 1;
        $steps = [$sPosition];
        $previousIndex = $sPosition;
        while(true) {
            $currentPipe = getPipe($loopMap, $currentIndex);
            $steps[] = $currentIndex;
            $nextIndex = $currentIndex + $directionMap[$currentPipe][$previousIndex - $currentIndex];

            if ($nextIndex === $sPosition) {
                break;
            }

            $previousIndex = $currentIndex;
            $currentIndex = $nextIndex;
        }

       $visual = str_replace([...array_keys($directionMap), '.'], '*', $loopMap);
        foreach ($steps as $step) {
            $visual = substr_replace($visual, $loopMap[$step], $step,1);
        }

        $lines = preg_split("/\r\n|\n|\r/", trim(chunk_split($visual, 140, )));

        $result = 0;
        foreach ($lines as $line) {
            $lastPos = 0;

            while (($lastPos = strpos($line, '*', $lastPos))!== false) {
                $x = substr_count($line, '|', 0, $lastPos);
                $l = substr_count($line, 'L', 0, $lastPos);
                $j = substr_count($line, 'J', 0, $lastPos);

                $y = $x + $l + $j;
                if ($y !== 0 && $y % 2 !== 0) {

                    $result++;
                }

                $lastPos = $lastPos + 1;
            }
        }

        echo "Result: {$result}\n"; // Test: 8 | Input: 445
    }
);
