<?php

function parseInput(): array {
    return explode(',', file_get_contents('input.txt'));
}

function h8sh(string $string): int {
    $hash = 0;
    for ($i = 0; $i < strlen($string); $i++) {
        $hash = (($hash + ord($string[$i])) * 17) % 256;
    }

    return $hash;
}
