<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        [$map, $directionMap, $l, $tiles] = parseInput();

        $splits = [[0, 1]];
        $paths = [];
        $tiles[0] = 1;

//        $x1 = range(-$l, -1);
//        $x2 = range($l * $l, $l * $l + $l);
//
//        $y1 = range(0)
//
//        var_dump($x1); die;

        $previous = null;
        foreach ($splits as &$split) {
            [$current, $offset] = $split;

            $min = 0;
            $max = strlen($map);
            if (abs($offset) === 1) {
                $min = $current - ($current % $l);
                $max = $min + ($l - 1);
            }

            var_dump($split);
            var_dump($min);
            var_dump($max);

            $i = $offset;
            while($current >= $min && $current <= $max && isset($map[$current])) {
                if (in_array([$previous, $current], $paths)) {
                    var_dump('loop');
                    var_dump($paths);
                    break;
                }

                $paths[] = [$previous, $current];

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
                        if (abs($previous - $current) === $l || abs($previous - $current) === 0) {
                            $splits[] = [$current, - 1];
                            $splits[] = [$current, 1];
                            $previous = $current;


                            $stop = true;

                            break;
                        }

                        $i = $directionMap[$tile][$previous - $current];

                        break;
                    case '|':
                        if (abs($previous - $current) === 1 || abs($previous - $current) === 0) {

                             var_dump('spl');
                            $splits[] = [$current, -$l];
                            $splits[] = [$current, $l];
                            $previous = $current;


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

        echo "Result: {$result}\n"; // Test: 51 | Input: 7593 too high
    }
);
