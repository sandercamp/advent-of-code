<?php

function parseInput(): array {
    $lines = file('2023/2/input.txt');

    $parsedInput = [];
    foreach ($lines as $line) {
        $trimmed = str_replace(' ', '', $line);
        [$game, $sets] = explode(':', $trimmed);
        $id = (int) str_replace('Game', '', $game);
        $chunks = explode(';', $sets);

        foreach ($chunks as $chunk) {
            $colors = explode(',', $chunk);
            $red = 0;
            $blue = 0;
            $green = 0;
            foreach ($colors as $color) {
                if (strpos($color, 'green')) {
                    $green = (int) $color;
                }

                if (strpos($color, 'blue')) {
                    $blue = (int) $color;
                }

                if (strpos($color, 'red')) {
                    $red = (int) $color;
                }
            }

            $parsedInput[$id][] = [
                'red' => $red,
                'green' => $green,
                'blue' => $blue
            ];
        }
    }

    return $parsedInput;
}