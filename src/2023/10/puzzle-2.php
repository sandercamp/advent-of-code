<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        [$map, $directions, $lineLength] = parseInput();
        $loop = drawLoop($map, $directions);

        $overlay = str_replace([...array_keys($directions), '.'], '*', $map);
        foreach ($loop as $step) {
            $overlay = substr_replace($overlay, $map[$step], $step,1);
        }

        $lines = preg_split("/\r\n|\n|\r/", trim(chunk_split($overlay, $lineLength)));

        $result = 0;
        $bounds = ['|', 'L', 'J'];
        foreach ($lines as $line) {
            $i = 0;
            while (($i = strpos($line, '*', $i)) !== false) {
                $reducer = fn(int $c, string $char) => $c + substr_count($line, $char, 0, $i);
                $count = array_reduce($bounds, $reducer, 0);
                if ($count % 2 !== 0) {
                    $result++;
                }

                $i++;
            }
        }

        echo "Result: {$result}\n"; // Test: 10 | Input: 445
    }
);
