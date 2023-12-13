<?php

function parseInput(): array {
    $lines = file('input.txt');

    $patterns = [];
    $rows = [];
    $columns = [];
    foreach ($lines as $line) {
        $trimmed = trim($line);

        $rows[] = $trimmed;

        for ($i = 0; $i< strlen($trimmed); $i++) {
            if (!isset($columns[$i])) {
                $columns[$i] = $trimmed[$i];
            } else {
                $columns[$i] .= $trimmed[$i];
            }
        }

        if (empty($trimmed)) {
            $patterns[] = [array_filter($rows), $columns];
            $rows = [];
            $columns = [];
        }
    }

    $patterns[] = [array_filter($rows), $columns];

    return array_chunk($patterns, 2);
}
