<?php

require_once('src/util.php');
require_once('helpers.php');

run(
    function() {
        [$times, $distances] = parseInput();
        $result = 1;
        foreach ($times as $index => $time) {
            $record = $distances[$index];

            $mid = floor($time / 2);

            $first = 0;
            for ($i = 0; $i <= $mid; $i++) {
                $remainder = $time - $i;
                $dist = $remainder * $i;

                if ($dist > $record) {
                    $first = $i;
                    break;
                }
            }

            $last = $time - $first;
            $times = $last - ($first - 1);

            $result *= $times;
        }


        echo "Result: {$result}\n"; // Test: 288
    }
);
