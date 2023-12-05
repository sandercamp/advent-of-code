<?php

require_once('src/util.php');
require_once('helpers.php');

run(
    function() {
        $maps = parseInput();
        $seeds = array_shift($maps);
        $result = null;
        foreach ($seeds as $seed) {
            $current = (int)$seed;
            foreach ($maps as $map) {
                foreach ($map as [$destination, $source, $length]) {
                    if ($current === $source) {
                        $current = $destination;
                        continue 2;
                    }

                    if ($current >= $source && $current <= $source + $length) {
                        $current = $destination + (binarySearch($source, $source + $length, $current) - $source);
                        break;
                    }
                }
            }

            if ($result === null || $current < $result) {
                $result = $current;
            }
        }

        echo "Result: {$result}\n"; // 331445006
    }
);
