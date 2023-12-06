<?php

require_once('src/util.php');
require_once('helpers.php');

run(
    function() {
        [$times, $distances] = parseInputTwo();

        $result = 1;
        foreach ($times as $index => $time) {
            $record = $distances[$index];
            for ($i = ceil($record / (int)$time); $i <= floor($time / 2); $i++) {
                if ($i * ($time - $i) > $record) {
                    $result *= ($time - $i) - ($i - 1);;
                    break;
                }
            }

        }

        echo "Result: {$result}\n"; // Test: 71503 | Part Two: 32607562
    }
);
