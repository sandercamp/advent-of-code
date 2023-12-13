<?php

function parseInput(): array {
    $lines = file('test.txt');

    $input = [];
    foreach ($lines as $line) {
        [$springs, $record] = explode(' ', trim($line));

        $groups = [];
        $brokenSprings = 0;

        $groups = explode(',', $record);

        for ($i = 0; $i < count($groups); $i++) {
            $length = (int)$groups[$i];
            $brokenSprings += $length;
            $pattern = str_repeat('#', $length);
            $isLast = !isset($groups[$i + 1]);
            $groups[$i] = $isLast ? $pattern : sprintf('%s.', $pattern);
        }

        $input[] = [$springs, $groups, $brokenSprings];
    }

    return $input;
}

function generate(string $string, array $groups, $offset = 0): int {
    $matches = [];

    $total = 0;
    foreach ($groups as $group) {
        $total += strlen($group);
    }

    $l = strlen($string);
    for ($i = 0; $i <= $l; $i++) {
        $offset = $i;
        $remainder = $total;
        for ($g = 0; $g < count($groups); $g++) {
            $subString = $groups[$g];

            if ($remainder < available(substr($string, $offset))) {
                continue;
            }

            if (isMatch(substr($string, $offset, strlen($subString)), $subString)) {
                $matches[$g][$offset] = $subString;
            }

            $offset = $offset + strlen($subString);
            $remainder = $remainder - strlen($subString);
        }
    }

    for ($m = 0; $m < count($matches) - 1; $m++) {
        foreach ($matches[$m] as $offset => $match) {
            if (overlaps($matches[$m + 1], [$offset, $match])) {
                unset($matches[$m][$offset]);
            }
        }
    }

    var_dump($matches);die;

    return array_reduce(
        $matches,
        fn(int $carry, array $matches) => $carry * count($matches),
        1
    );
}

function available(string $string): int {
    $unknown = substr_count($string, '?');
    $broken = substr_count($string, '#');

    return $unknown + $broken;
}


function overlaps(array $matches, array $match): bool {
    [$offsetA, $stringA] = $match;

    $x1 = $offsetA;
    $x2 = $x1 + strlen($stringA);
    foreach ($matches  as $offsetB => $stringB) {
        $y1 = $offsetB;
        $y2 = $y1 + strlen($stringB);

        if ($x1 < $y2 && $y1 < $x2) {
            return true;
        }
    }

    return false;
}

function isMatch(string $a, string $b): bool {
    if ($a === $b) {
        return true;
    }

    if (strlen($a) === strlen($b)) {
        for ($i = 0; $i < strlen($b); $i++) {
            if (!($a[$i] === '?' || $a[$i] === $b[$i])) {
                return false;
            }
        }

        return true;
    }

    return false;
}


function generateB(string $string, array $chars, array $positions) {
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


