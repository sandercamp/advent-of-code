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
                    if ($rows[$i] === $rows[$i + 1]) {
                        $found = true;
                        for ($j = $i - 1, $k = $i + 2; $j >= 0 && $k < count($rows) ; $j--, $k++) {
                            if ($rows[$j] !== $rows[$k]) {
                                $found = false;
                            }
                        }

                        if ($found) {
                            $rowCounts[] = $i + 1;
                            break;
                        }
                    }
                }

                for ($i = 0; $i < count($columns) - 1; $i++) {
                    if ($columns[$i] === $columns[$i + 1]) {
                        $found = true;
                        for ($j = $i - 1, $k = $i + 2; $j >= 0 && $k < count($columns) ; $j--, $k++) {
                            if ($columns[$j] !== $columns[$k]) {
                                $found = false;
                            }
                        }

                        if ($found) {
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

        echo "Result: {$result}\n"; // Test: 405 | Input: 36015
    }
);
