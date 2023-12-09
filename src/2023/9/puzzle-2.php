<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        echo sprintf("Result: %d\n", sumExtrapolation(parseInput(true))); // Test:  2 | Input: 913
    }
);
