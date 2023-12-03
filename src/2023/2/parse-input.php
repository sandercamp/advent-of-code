<?php

function parseInput(): array {
    $lines = str_replace(' ', '', file('src/2023/2/test.txt'));
    $colors = ['green', 'red', 'blue'];
    $defaults = array_fill_keys($colors, 0);
    $parsedInput = [];

    $extractGameId = fn(string $game): string => (int) str_replace('Game', '', $game);
    $extractData = fn(string $game): array => explode(':', $game);
    $extractSets = fn(string $sets): array => explode(';', $sets);
    $extractColorData = fn(string $set): array => explode(',', $set);

    foreach ($lines as $line) {
        [$game, $sets] = $extractData($line);
        $id = $extractGameId($game);
        foreach ($extractSets($sets) as $set) {
            $result = $defaults;
            foreach ($extractColorData($set) as $part) {
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
