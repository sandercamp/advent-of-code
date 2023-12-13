<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        $input = parseInput();

        $result = 0;
        foreach ($input as $patterns) {
            $rowCounts = [];
            $columnCounts = [];

            foreach ($patterns as $p => [$rows, $columns]) {
                // Check rows
                for ($i = 0; $i < count($rows) - 1; $i++) {
                    $a = str_split($rows[$i]);
                    $b = str_split($rows[$i + 1]);
                    $adjustments = strlen($rows[$i]) - count(array_intersect_assoc($a, $b));

                    if ($adjustments <= 1) {
                        for ($j = $i - 1, $k = $i + 2; $j >= 0 && $k < count($rows) ; $j--, $k++) {
                            $a = str_split($rows[$j]);
                            $b = str_split($rows[$k]);
                            $adjustments += strlen($rows[$i]) - count(array_intersect_assoc($a, $b));
                        }

                        if ($adjustments === 1) {
                            $rowCounts[] = $i + 1;
                            break;
                        }
                    }
                }

                for ($i = 0; $i < count($columns) - 1; $i++) {
                    $a = str_split($columns[$i]);
                    $b = str_split($columns[$i + 1]);
                    $adjustments = strlen($columns[$i]) - count(array_intersect_assoc($a, $b));

                    if ($adjustments <= 1) {
                        for ($j = $i - 1, $k = $i + 2; $j >= 0 && $k < count($columns) ; $j--, $k++) {
                            $a = str_split($columns[$j]);
                            $b = str_split($columns[$k]);
                            $adjustments += strlen($columns[$i]) - count(array_intersect_assoc($a, $b));
                        }

                        if ($adjustments === 1) {
                            $columnCounts[] = $i + 1;
                            break;
                        }
                    }
                }
            }

            foreach ($rowCounts as $rowCount) {
                $result += $rowCount * 100;
            }

            foreach ($columnCounts as $columnCount) {
                $result += $columnCount;
            }
        }

        echo "Result: {$result}\n"; // Test: 400 | Input: 35335
    }
);
