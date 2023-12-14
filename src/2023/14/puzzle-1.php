<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        $input = parseInput();

        $input = turn($input);
        $input = shift($input);
        $result = calculate($input);

        echo "Result: {$result}\n"; // Test: 136 | Input: 113525
    }
);
