<?php

function parseInput(): array {
    return file('input.txt');
}

function turn(array $lines) {
    $parsedInput = array_fill(0, count($lines), '');
    foreach ($lines as $line) {
        for ($i = 0; $i < strlen(trim($line)); $i++) {
            $parsedInput[$i] = $line[$i] . $parsedInput[$i];
        }
    }

    return $parsedInput;
}

function shift(array $lines): array {
    for ($l = 0; $l < count($lines); $l++) {
        $line = $lines[$l];
        $current = [];
        for ($i = 0; $i < strlen($line); $i++) {
            if ($line[$i] === '#') {
                for($j = $i, $k = count($current); $k > 0; $j--, $k--) {
                    foreach ($current as $offset) {
                        $lines[$l][$offset] = '.';
                    }

                    for ($o = $i - 1, $p = 0; $p < count($current); $o--, $p++) {
                        $lines[$l][$o] = 'O';
                    }
                }

                $current = [];
            }

            if ($line[$i] === 'O') {
                $current[] = $i;
            }
        }

        if (count($current) > 0) {
            foreach ($current as $offset) {
                $lines[$l][$offset] = '.';
            }

            for ($o = $i - 1, $p = 0; $p < count($current); $o--, $p++) {
                $lines[$l][$o] = 'O';
            }
        }
    }

    return $lines;
}

function calculate(array $array): int {
    $result = 0;

    foreach ($array as $line) {
        for ($i = 0; $i < strlen($line); $i++) {
            if ($line[$i] === 'O') {
                $result += $i + 1;
            }
        }
    }

    return $result;
}
