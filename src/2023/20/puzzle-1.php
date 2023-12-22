<?php

namespace AdventOfCode\Day20;

require_once __DIR__.'/../../../vendor/autoload.php';

require_once('../../util.php');
require_once('helpers.php');

run(
    function() {
        $configuration = parseInput();

        for ($i = 0; $i < 1000; $i++) {
            $configuration->handlePulse(new Pulse(0, 'button', 'broadcaster'));
        }

        $result = $configuration->countLowPulses() * $configuration->countHighPulses();

        echo "Result: {$result}\n"; // Test: 11687500 | Input: 680278040
    }
);
