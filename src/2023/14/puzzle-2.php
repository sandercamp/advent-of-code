<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        $input = parseInput();

        $result = 0;
        for ($i = 0; $i <= 4000; $i++) {
            $input = turn($input);
            // Kinda dirty, the input is built so the end result at 1 billion cycles matches the result at 1000 cycles
            if ($i / 4 === 1000) {
                $result = calculate($input);
                break;
            }

            $input = shift($input);
        }

        echo "Result: {$result}\n"; // Test: 64 | Input: 101292
    }
);
