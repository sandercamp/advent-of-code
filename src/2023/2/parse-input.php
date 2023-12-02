<?php

function parseInput(): array {
    $lines = file('src/2023/2/input.txt');
    $colors = ['green', 'red', 'blue'];
    $parsedInput = [];
    foreach ($lines as $line) {
        [$game, $sets] = explode(':', str_replace(' ', '', $line));
        $id = (int) str_replace('Game', '', $game);
        foreach (explode(';', $sets) as $set) {
            $result = array_fill_keys($colors, 0);
            foreach (explode(',', $set) as $part) {
                foreach ($colors as $color) {
                    if (strpos($part, $color)) {
                        $result[$color] = (int)$part;
                    }
                }
            }

            $parsedInput[$id][] = $result;
        }
    }

    return $parsedInput;
}
