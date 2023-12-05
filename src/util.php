<?php

function run(callable $do) {
    $timeStart = microtime(true);

    $do();

    $ms = (microtime(true) - $timeStart) * 1000;
    $mib = memory_get_peak_usage() / 1024 / 1024;

    echo "Execution time (ms): {$ms}\n";
    echo "Peak memory usage (MiB): {$mib}\n";
}
