<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        echo sprintf("Result: %d\n", sumExtrapolation(parseInput())); // Test:  114 | Input: 1789635132
    }
);
