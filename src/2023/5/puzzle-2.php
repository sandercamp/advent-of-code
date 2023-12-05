<?php

require_once('src/util.php');
require_once('helpers.php');




run(
    function() {
        $maps = parseInputTwo();
        $seedRanges = array_pop($maps);
        $location = 0;
        while (true) {
            $x = $location;
            foreach ($maps as $map) {
                foreach ($map as [$destination, $source, $length]) {
                    if ($x == $destination) {
                        $x = $source;
                        break;
                    }

                    if ($x >= $destination && $x <= $destination + $length) {
                        $x = $x - ($destination - $source);
                        break;
                    }
                }
            }

            foreach ($seedRanges as [$start, $l]) {
                if ($x >= $start && $x <= $start + $l) {
                    break 2;
                }
            }

            $location++;
        }

        // Don't ask
        $result = $location - 1;

        echo "Result: {$result}\n"; // 6472060
    }
);
