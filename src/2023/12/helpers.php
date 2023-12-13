<?php

function parseInput(): array {
    $lines = file('test.txt');

    $input = [];
    foreach ($lines as $line) {
        [$springs, $record] = explode(' ', trim($line));

        $groups = [];
        $brokenSprings = 0;
        foreach (explode(',', $record) as $group) {
            $brokenSprings += (int)$group;
            $groups[] = (int)$group;
        }


        $input[] = [$springs, $groups, $brokenSprings];
    }

    return $input;
}

function generate(string $string, array $chars, array $positions) {
    $result = [];

    foreach (['.', '#'] as $char) {
        foreach ($positions as $key => $position) {
            $permutation = substr_replace($string, $char, $position, 1);

            $otherPositions = $positions;
            unset($otherPositions[$key]);

            $result = [...$result, $permutation, ...generate($permutation, $chars, $otherPositions)];
        }
    }

    return array_unique(array_filter($result, fn(string $string) => !strpos($string, '?')));
}


