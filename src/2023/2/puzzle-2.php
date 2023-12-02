<?php

require_once('parse-input.php');

$colors = ['green', 'red', 'blue'];

var_dump(
    array_sum(
        array_map(
            fn ($game) => array_product(array_map(fn ($color) => max(array_column($game, $color)), $colors)),
            parseInput()
        )
    )
); // 63307
