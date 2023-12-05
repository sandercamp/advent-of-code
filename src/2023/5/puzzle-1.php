<?php

require_once('src/util.php');
require_once('helpers.php');

ini_set('memory_limit', '1024M');

run(
    function() {
        $maps = parseInput();
        $seeds = array_shift($maps);
        $locations = [];
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

            $locations[] = $current;
        }

        $result = min($locations);

        echo "Result: {$result}\n"; // 331445006
    }
);
