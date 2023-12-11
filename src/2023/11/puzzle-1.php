<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        $lines = parseInput();

        // Find galaxy coordinates
        $galaxies = [];
        $ySize = count($lines);
        $xSize = strlen(trim($lines[0]));
        foreach ($lines as $y => $line) {
            $x = 0;
            while(($x = strpos($line, '#', $x)) !== false) {
                $galaxies[] = ['x' => $x, 'y' => $y];
                $x++;
            }
        }

        $emptyColumns = array_diff(range(0, $xSize - 1), array_column($galaxies, 'x'));
        $emptyRows = array_diff(range(0, $ySize - 1), array_column($galaxies, 'y'));

        // Expand universe
        foreach ($galaxies as $i => ['x' => $x, 'y' => $y]) {
            $expandX = count(array_filter($emptyColumns, fn(int $emptyX) => $emptyX < $x));
            $expandY = count(array_filter($emptyRows, fn(int $emptyY) => $emptyY < $y));

            $galaxies[$i]['x'] = $x + $expandX;
            $galaxies[$i]['y'] = $y + $expandY;
        }

        // Calculate distances

        $dist = [];
        $result = 0;
        foreach ($galaxies as $i => ['x' => $x1, 'y' => $y1]) {
            foreach ($galaxies as $j => ['x' => $x2, 'y' => $y2]) {
                if (!isset($dist[$i][$j]) && !isset($dist[$j][$i])) {
                    $dist[$i][$j] = abs($x1 - $x2) + abs($y1 - $y2);
                    $result += $dist[$i][$j];
                }
            }
        }

        echo "Result: {$result}\n"; // Test: 374 | Input: 9974721
    }
);
