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

    $filteredNumbers = [];
    foreach ($lines as $line) {
        $parsedLine = str_replace(array_values($map), array_keys($map), $line);
        $numbers = str_split(filter_var($parsedLine, FILTER_SANITIZE_NUMBER_INT));
        $filteredNumbers[] = "{$numbers[0]}{$numbers[count($numbers) - 1]}";
    }

    var_dump(array_sum($filteredNumbers));
})();
