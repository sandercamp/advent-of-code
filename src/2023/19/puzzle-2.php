<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        [$workflows, $_] = parseInput();

        $part = [
            'x' => [1, 4000],
            'm' => [1, 4000],
            'a' => [1, 4000],
            's' => [1, 4000],
        ];

        $result = processPartTwo($part, $workflows, 'in');

        // 586354236668000
        // 167409079868000
        // 140809783868000
        // 134343280273968
        // 84775791548965

        echo "Result: {$result}\n"; // Test: 167409079868000 | Input: 84775791548965 too low
    }
);
