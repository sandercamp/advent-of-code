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
    $remainders = [];
    foreach ($groups as $group) {
        $total += strlen($group);
    }

    $remainder = $total;
    foreach ($groups as $g => $group) {
        $remainders[$g] = $remainder;
        $remainder -= strlen($group);
    }

    $l = strlen($string);
    for ($i = 0; $i <= $l; $i++) {
        $offset = $i;
        for ($g = 0; $g < count($groups); $g++) {
            $subString = $groups[$g];

            if ($g === 0) {
                var_dump('Remainder: ' . $remainders[$g]);
                var_dump('Available: ' . available(substr($string, $offset)));
            }

            if ($remainders[$g] > available(substr($string, $offset))) {
                continue;
            }
            if ($g === 0) {
                var_dump($offset);
                var_dump('sub: ' . $subString);
                var_dump('match: ' . isMatch($string, $offset, $subString));
            }


            if (isMatch($string, $offset, $subString)) {


                $matches[$g][$offset] = $subString;
            }

            $offset = $offset + strlen($subString);
        }
    }

//    for ($m = 0; $m < count($matches) - 1; $m++) {
//        foreach ($matches[$m] as $offset => $match) {
//            if (overlaps($matches[$m + 1], [$offset, $match])) {
//                unset($matches[$m][$offset]);
//            }
//        }
//    }

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

function isMatch(string $string, int $offset, string $sub): bool {
    $x = substr($string, $offset, strlen($sub));

    if (strlen($x) === strlen($sub)) {
        if ($offset > 0 && $string[$offset - 1] == '#') {
            return false;
        }

        for ($i = 0; $i < strlen($sub); $i++) {
            if (!($x[$i] === '?' || $x[$i] === $sub[$i])) {
                return false;
            }
        }

        return true;
    }

    return false;
}


function generateB(string $string, array $groups, $offset = 0): array {
    $matches = [];

    for ($i = 0; $i <= strlen($string); $i++) {
        $offset = $i;
        for ($g = 0; $g < count($groups); $g++) {
            $subString = $groups[$g];

            if (isMatch($string, $offset, $subString)) {
                $matches[$g][] = [$offset, $subString];
            }

            $offset = $offset + strlen($subString);
        }
    }

    $strings = combinations($string, $matches);

    var_dump($strings);die;
    return $result;
}

function generateStrings(array $matches, array $groups) {

}

function combinations(string $string, $arrays, $i = 0) {
    if (!isset($arrays[$i])) {
        return array();
    }
    if ($i == count($arrays) - 1) {
        return $arrays[$i];
    }

    // get combinations from subsequent arrays
    $tmp = combinations($string, $arrays, $i + 1);

    $result = array();

    // concat each array from tmp with each element from $arrays[$i]
    foreach ($arrays[$i] as [$offset, $sub]) {
        foreach ($tmp as $string) {
            $result[] = substr_replace($string, $sub, $offset, strlen($sub));
        }
    }

    return $result;
}

function matchesGroups(string $string, array $groups) {
    $filtered = array_values(array_filter(
        explode('.', $string),
        fn (string $string) => substr_count($string, '#')
    ));

    if (count($filtered) !== count($groups)) {
        return false;
    }

    foreach ($groups as $i => $group) {
        if (substr_count($group, '#') !== substr_count($filtered[$i], '#')) {
            return false;
        }
    }

    return true;
}


