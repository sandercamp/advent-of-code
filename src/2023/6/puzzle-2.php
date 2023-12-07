<?php

require_once('src/util.php');
require_once('helpers.php');

run(
    function() {
        [$times, $distances] = parseInputTwo();

        $result = 1;
        $j = 0;
        foreach ($times as $index => $time) {
            $record = $distances[$index];

            $x = ceil($record / $time);


            var_dump($record);

            var_dump($x);

            var_dump($x * ($time - ($x - 1)));

            $x += 1;
            var_dump($x * ($time - ($x - 1)));

            die;




            for ($i = ceil($record / (int)$time); $i <= floor($time / 2); $i++) {
                $j++;
                if ($i * ($time - $i) > $record) {
                    $result *= ($time - $i) - ($i - 1);;
                    break;
                }
            }
        }


        var_dump($j);
        echo "Result: {$result}\n"; // Test: 71503 | Part Two: 32607562
    }
);
