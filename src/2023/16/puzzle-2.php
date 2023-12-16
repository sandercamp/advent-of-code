<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        [$map, $directions] = parseInput();

        $entryPoints = [];
        for ($i = 0; $i < count($map); $i++) {
            $entryPoints[] = [0, $i, DOWN];
            $entryPoints[] = [$i, 0, RIGHT];
            $entryPoints[] = [count($map) - 1, $i, UP];
            $entryPoints[] = [$i, count($map) - 1, LEFT];
        }

        $results = [];
        $scorecards = [];
        foreach ($entryPoints as $i => $entryPoint) {
            echo sprintf("Entrypoint %d of %d\n", $i, count($entryPoints));

            $scorecards[$i] = $map;
            $coordinates = [$entryPoint];
            $moves = [];
            foreach ($coordinates as &$coordinate) {
                [$x, $y, $source] = $coordinate;
                while(isset($map[$x][$y])) {
                    $scorecards[$i][$x][$y] = '#';

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

            $results[$i] = array_reduce(
                $scorecards[$i],
                fn(int $carry, array $row) => $carry += array_reduce(
                    $row,
                    fn(int $carry, string $tile) => $carry += $tile === '#' ? 1 : 0,
                    0
                ),
                0
            );
        }

        $result = max($results);

        echo "Result: {$result}\n"; // Test: 51 | Input: 7676 too low
    }
);
