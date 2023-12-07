<?php

require_once('src/util.php');
require_once('helpers.php');

run(
    function() {
        //var_dump(determineTypeTwo('J243T'));die;

        $parsedInput = parseInputTwo();

        usort($parsedInput, 'compareHands');

        var_dump(array_reverse($parsedInput));

        $result = 0;
        foreach ($parsedInput as $rank => [$hand, $type, $bid]) {
            $result += $bid * ($rank + 1);
        }

        echo "Result: {$result}\n"; // Test: 5905 | Input:250755480 too low
    }
);
