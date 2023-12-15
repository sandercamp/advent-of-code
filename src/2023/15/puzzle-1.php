<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        echo sprintf(
            "Result: %d\n",
            array_reduce(parseInput(), fn(int $c, string $s) => $c += h8sh($s), 0)
        ); // Test: 52 | Input: 509784
    }
);
