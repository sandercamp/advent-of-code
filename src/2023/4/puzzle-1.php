<?php

require_once('src/util.php');
require_once('helpers.php');

run(
    function() {
        var_dump(
            array_sum(
                array_map(
                    fn(array $game): int => doubleConsecutive(count(array_intersect(...$game))),
                    parseInput()
                )
            )
        ); // 18519
    }
);
