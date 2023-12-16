<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        [$map, $directionMap, $l, $tiles] = parseInput();

        $splits = [[0, 1]];
        $paths = [];
        $tiles[0] = 1;

        foreach ($splits as &$split) {
            [$previous, $offset] = $split;
            $current = $previous + $offset;

            $min = 0;
            $max = strlen($map);
            if (abs($offset) === 1) {
                $min = $previous - ($previous % $l);
                $max = $min + ($l - 1);
            }

            $i = $offset;
            while($current >= $min && $current <= $max && isset($map[$current])) {
                if (in_array([$previous, $current], $paths)) {
                    break;
                }

                $paths[] = [$previous, $current];

                if ($current === 69) {
                    die;
                }
                $stop = false;
                $tile = $map[$current];
                $tiles[$current]++;

                switch ($tile) {
                    case '/':
                        $i = $directionMap[$tile][$previous - $current];
                        break;
                    case '\\':
                        $i = $directionMap[$tile][$previous - $current];
                        break;
                    case '-':
                        if (abs($previous - $current) === $l) {
                            $splits[] = [$current, - 1];
                            $splits[] = [$current, 1];

                            $stop = true;

                            break;
                        }

                        $i = $directionMap[$tile][$previous - $current];

                        break;
                    case '|':
                        if (abs($previous - $current) === 1) {
                            $splits[] = [$current, -$l];
                            $splits[] = [$current, $l];

                            $stop = true;
                            break;
                        }

                        $i = $directionMap[$tile][$previous - $current];
                        break;
                    default:
                        // Do nothing
                }

                if ($stop) {
                    break;
                }

                $min = 0;
                $max = strlen($map);
                if (abs($i) === 1) {
                    $min = $current - ($current % $l);
                    $max = $min + ($l - 1);
                }

                $previous = $current;
                $current += $i;
            }
        }

        $result = count(array_filter($tiles, fn(int $tileCount) => $tileCount > 0));

        echo "Result: {$result}\n"; // Test: 46 | Input: 7472 too high
    }
);
