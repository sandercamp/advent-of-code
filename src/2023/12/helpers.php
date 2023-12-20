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

function calculatePermutations(string $string, array $groups): int
{
    $permutations = [];
    //global $cache;
    $result = 0;

    //$cacheKey = sprintf('%s-%s', $string, implode(',', $groups));
//    if (isset($cache[$cacheKey])) {
//        return $cache[$cacheKey];
//    }


    if (($pos = strpos($string, '?')) !== false) {
        foreach (['#', '.'] as $option) {
            $string = substr_replace($string, $option, $pos, 1);

            $unknown = 0;
            $broken = 0;
            $group = 0;
            for ($i = 0; $i < strlen($string); $i++) {
                if ($i === 0 && $string[$i] === '.') {
                    continue;
                }

                if ($string[$i] === '#') {
                    $broken++;
                }

                if ($string[$i] === '?') {
                    if (isset($groups[$group]) && $broken + $unknown === (int)$groups[$group]) {
                        $string = substr_replace($string, '.', $i, 1);

                        $result += calculatePermutations(substr($string, $i + 1), array_slice($groups, $group + 1));

                        continue;
                    }

                    $unknown++;
                }

                if ($string[$i] === '.' && ($unknown > 0 || $broken > 0)) {
                    if (!isset($groups[$group]) || $broken !== (int)$groups[$group]) {
                        break;
                    }

                    $result += calculatePermutations(substr($string, $i), array_slice($groups, $group + 1));

                    // New group: reset counts
                    $unknown = 0;
                    $broken = 0;
                    $group++;
                }
            }
        }

        return $result;
    }

    if (matchesGroups($string, $groups)) {
        return 1;
    }

    var_dump($string);
    var_dump($groups);

    return 0;
}

function canProceed(string $string, array $groups): bool {
    $unknown = 0;
    $broken = 0;
    $group = 0;
    for ($i = 0; $i < strlen($string); $i++) {
        if ($i === 0 && $string[$i] === '.') {
            continue;
        }

        if ($string[$i] === '?') {
            $unknown++;
        }

        if ($string[$i] === '#') {
            $broken++;
        }

        if ($string[$i] === '.' && $unknown === 0 && $broken > 0) {
            if (!isset($groups[$group])) {
                return false;
            }

            if ($broken != $groups[$group]) {
                return false;
            }

            // New group: reset counts
            $unknown = 0;
            $broken = 0;
            $group++;
        }
    }

    return true;
}

function matchesGroups(string $string, array $groups): bool {
    //var_dump('Matcher');

//    if (count($groups) === 0 && !str_contains($string,'#')) {
//        return true;
//    }

//    if (str_contains($string, '?')) {
//        return false;
//    }

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


