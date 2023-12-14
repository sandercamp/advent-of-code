<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        $result = calculate(shift(turn(parseInput())));

        echo "Result: {$result}\n"; // Test: 136 | Input: 113525
    }
);
