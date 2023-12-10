<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        [$map, $directions] = parseInput();
        $loop = drawLoop($map, $directions);

        $result = count($loop) / 2;

        echo "Result: {$result}\n"; // Test: 8 | Input: 7145
    }
);
