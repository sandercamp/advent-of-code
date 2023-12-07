<?php

require_once('src/util.php');
require_once('helpers.php');

run(
    function() {
        $parsedInput = parseInputTwo();

        usort($parsedInput, 'compareHands');

        $result = 0;
        foreach ($parsedInput as $rank => [$hand, $type, $bid]) {
            $result += $bid * ($rank + 1);
        }

        echo "Result: {$result}\n"; // Test: 5905 | Input: 250757288
    }
);
