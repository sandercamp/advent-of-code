<?php

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        $instructions = parseInput();
        $boxes = array_fill(0, 256, []);
        foreach ($instructions as $instruction) {
            [$label, $length] = preg_split('/(-|=)/', $instruction);
            $box = h8sh($label);

            if (empty($length)) {
                unset($boxes[$box][$label]);
            } else {
                $boxes[$box][$label] = $length;
            }
        }

        $i = 1;
        $result = 0;
        foreach ($boxes as $box) {
            $j = 1;
            foreach ($box as $length) {
                $result += $i * $j * $length;
                $j++;
            }

            $i++;
        }

        echo "Result: {$result}\n"; // Test: 145 | Input: 230197
    }
);
