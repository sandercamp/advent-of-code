<?php

function parseInput(): array {
    $lines = file('test.txt');

    $input = [];
    foreach ($lines as $line) {
        [$springs, $record] = explode(' ', trim($line));
        $groups = explode(',', $record);
        $input[] = [$springs, $groups];
    }

    return $input;
}

function parseInputAndUnfold(): array {
    $lines = file('test.txt');

    $input = [];
    foreach ($lines as $line) {
        [$springs, $record] = explode(' ', trim($line));
        $groups = explode(',', $record);

        $springs = sprintf('%1$s?%1$s?%1$s?%1$s?%1$s', $springs);
        $groups = [...$groups, ...$groups, ...$groups, ...$groups, ...$groups];
        $input[] = [$springs, $groups];
    }

    return $input;
}
global $cache;
$cache = [];

function generatePermutations(string $string): array
{
    global $cache;
    $permutations = [];
    if (($unknown = strpos($string, '?')) !== false) {
        if (isset($cache[$string])) {
            return $cache[$string];
        }

        foreach (['#', '.'] as $option) {
            $string = substr_replace($string, $option, $unknown, 1);
            $cache[$string] = $permutations = [$string, ...$permutations, ...generatePermutations($string)];
        }

        return $permutations;
    } else {
        return [$string];
    }
}

function matchesGroups(string $string, array $groups): bool {
    if (str_contains($string, '?')) {
        return false;
    }

    $filtered = array_values(array_filter(
        explode('.', $string),
        fn (string $string) => substr_count($string, '#')
    ));

    if (count($filtered) !== count($groups)) {
        return false;
    }

    foreach ($groups as $i => $group) {
        if (substr_count($filtered[$i], '#') != $group) {
            return false;
        }
    }

    return true;
}


