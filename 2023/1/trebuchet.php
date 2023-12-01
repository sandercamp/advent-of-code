<?php

(function() {
    $lines = file('2023/1/input.txt');

    $map = [
        'ni9ne' => 'nine',
        'ei8ght' => 'eight',
        'se7ven' => 'seven',
        'si6x' => 'six',
        'f5ive' => 'five',
        'f4our' => 'four',
        'th3ree' => 'three',
        't2wo' => 'two',
        'o1ne' => 'one'
    ];

    $parsedLines = array_map(
        fn (string $line) => str_replace(
            array_values($map),
            array_keys($map),
            $line
        ),
        $lines
    );

    $integers = range(1, 9);
    $numbers = array_map(
        fn(string $line) => array_values(array_filter(str_split($line), fn(string $char) => in_array($char, $integers))),
        $parsedLines
    );

    $filtered = array_map(
        fn (array $sub) => "{$sub[0]}{$sub[count($sub) - 1]}",
        $numbers
    );

    var_dump(array_sum($filtered));
})();
