<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        [$map, $directions, $lineLength] = parseInput();
        $loop = drawLoop($map, $directions);

        $overlay = str_replace([...array_keys($directions), '.'], '*', $map);
        foreach ($loop as $step) {
            $overlay = substr_replace($overlay, $map[$step], $step,1);
        }

        $lines = preg_split("/\r\n|\n|\r/", trim(chunk_split($overlay, $lineLength)));

        $result = 0;
        foreach ($lines as $line) {
            $lastPos = 0;
            while (($lastPos = strpos($line, '*', $lastPos)) !== false) {
                $x = substr_count($line, '|', 0, $lastPos);
                $l = substr_count($line, 'L', 0, $lastPos);
                $j = substr_count($line, 'J', 0, $lastPos);

                $y = $x + $l + $j;
                if ($y % 2 !== 0) {
                    $result++;
                }

                $lastPos += 1;
            }
        }

        echo "Result: {$result}\n"; // Test: 10 | Input: 445
    }
);
