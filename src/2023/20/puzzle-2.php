<?php

namespace AdventOfCode\Day20;

use GMP;

require_once __DIR__.'/../../../vendor/autoload.php';

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
//        $configuration = parseInput();
//
//        while(true) {
//            $configuration->pressButton();
//            $configuration->handlePulse(new Pulse(0, 'button', 'broadcaster'));
//        }

        // pm mk pk hf
        // pm 3881 7762 11643
        // pk 4021 8042
        // mk 3889 7778 11643
        // hf 4013 8026

        $result = array_reduce(
            [3881, 4021, 3889, 4013],
            fn (GMP $carry, int $count) => gmp_lcm($carry, $count),
            gmp_init(1)
        );

        echo "Result: {$result}\n"; // Test: ? | Input: ?
    }
);
