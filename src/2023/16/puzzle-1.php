<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        [$map, $directions] = parseInput();
        $scorecard = $map;
        $coordinates = [[0, 0, RIGHT]];
        $moves = [];
        foreach ($coordinates as &$coordinate) {
            [$x, $y, $source] = $coordinate;
            while(isset($map[$x][$y])) {
                $scorecard[$x][$y] = '#';

                if (in_array([$x, $y, $source], $moves)) {
                    break;
                }

                $moves[] = [$x, $y, $source];

                $stop = false;
                $direction = $directions[$map[$x][$y]][$source];

                switch ($direction) {
                    case UP:
                        $x--;
                        break;
                    case DOWN:
                        $x++;
                        break;
                    case LEFT:
                        $y--;
                        break;
                    case RIGHT:
                        $y++;
                        break;
                    case SPLIT_LEFT_RIGHT:
                        $coordinates[] = [$x, $y, LEFT];
                        $coordinates[] = [$x, $y, RIGHT];
                        $stop = true;
                        break;
                    case SPLIT_UP_DOWN:
                        $coordinates[] = [$x, $y, UP];
                        $coordinates[] = [$x, $y, DOWN];
                        $stop = true;
                        break;
                    default:
                        // Do nothing
                }

                if ($stop) {
                    break;
                }

                $source = $direction;
            }
        }

        $result = array_reduce(
            $scorecard,
            fn(int $carry, array $row) => $carry += array_reduce(
                $row,
                fn(int $carry, string $tile) => $carry += $tile === '#' ? 1 : 0,
                0
            ),
            0
        );

        echo "Result: {$result}\n"; // Test: 46 | Input: 7472
    }
);
