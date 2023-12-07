<?php

require_once('src/util.php');
require_once('helpers.php');

run(
    function() {
        $parsedInput = parseInput();

        usort($parsedInput, 'compareHands');

        $result = 0;
        foreach ($parsedInput as $rank => [$hand, $type, $bid]) {
            $result += $bid * ($rank + 1);
        }

        echo "Result: {$result}\n"; // Test:  6440 | Input: 251287184
    }
);
