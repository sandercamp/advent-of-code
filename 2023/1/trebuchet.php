<?php

(function() {
    $lines = file('2023/1/input.txt');
    $range = range(1, 9);
    $numbers = array_map(
        fn(string $line) => array_values(array_filter(str_split($line), fn(string $char) => in_array($char, $range))),
        $lines
    );

    $filtered = array_map(
        fn (array $sub) => "{$sub[0]}{$sub[count($sub) - 1]}",
        $numbers
    );

    var_dump(array_sum($filtered));
})();
