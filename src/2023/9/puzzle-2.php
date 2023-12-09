<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        var_dump(sumExtrapolation(parseInputTwo()) === 913);
        echo sprintf("Result: %d\n", sumExtrapolation(parseInputTwo())); // Test:  2 | Input: 913
    }
);
