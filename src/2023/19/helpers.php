<?php

function parseInput(): array {
    [$w, $p] = preg_split("#\n\s*\n#Uis", file_get_contents('test.txt'));

    $workflows = [];
    foreach (explode("\n", $w) as $workflow) {
        $name = '';
        $rules = '';
        $ruleBlock = false;
        for ($i = 0; $i < strlen($workflow); $i++) {
            if ($workflow[$i] === '{' || $workflow[$i] === '}') {
                $ruleBlock = true;
                continue;
            }

            if ($ruleBlock) {
                $rules .= $workflow[$i];
            } else {
                $name .= $workflow[$i];
            }
        }

        $workflows[$name] = parseRules($rules);
    }

    $parts = [];
    foreach (explode("\n", $p) as $part) {
        $key = '';
        $valueBlock = false;
        $value = '';
        $parsedPart = [];
        for ($i = 0; $i < strlen($part); $i++) {
            if (in_array($part[$i], ['x', 'a', 's', 'm'])) {
                $key = $part[$i];
                continue;
            }

            if ($part[$i] === '=') {
                $valueBlock = true;
                continue;
            }

            if (in_array($part[$i], [',', '}'])) {
                $valueBlock = false;
                $parsedPart[$key] = (int)$value;
                $value = '';
                continue;
            }

            if ($valueBlock) {
                $value .= $part[$i];
            }
        }

        $parts[] = $parsedPart;
    }

    return [$workflows, $parts];
}


function parseRules(string $rule): callable {
    $operators = [
        '>' => function(array $a, $b) {
            [$min, $max] = $a;

            // false, true
            return [[min($min, $b), min($b, $max)], [max($b + 1, $min), max($max, $b + 1)]];
        },
        '<' => function(array $a, $b) {
            [$min, $max] = $a;

            // false, true
            return [[max($b, $min), max($b, $max)], [min($b - 1, $min), min($b - 1, $max)]];
        }
    ];

    $argument = '';
    $conditionalValue = '';
    $inConditionalValue = false;
    $inReturnValue = false;
    $returnValue = '';
    $if = fn($a, $b) => null;
    $conditionals = [];
    for ($i = 0; $i < strlen($rule); $i++) {
        if (isset($operators[$rule[$i]])) {
            $if = $operators[$rule[$i]];
            $inConditionalValue = true;
            continue;
        }

        // Conditional ends
        if ($rule[$i] === ',') {
            $conditionals[] = function(array $part) use($argument, $conditionalValue, $if, $returnValue) {
                [$false, $true] = $if($part[$argument], $conditionalValue);

                return [
                    [0 => [...$part, $argument => $false]],
                    [$returnValue => [...$part, $argument => $true]]
                ];
            };

            // Reset all values
            $inReturnValue = false;
            $argument = '';
            $returnValue = '';
            $conditionalValue = '';

            continue;
        }

        if ($rule[$i] === ':') {
            $inConditionalValue = false;
            $inReturnValue = true;
            continue;
        }

        if ($inConditionalValue) {
            $conditionalValue .= $rule[$i];
            continue;
        }

        if ($inReturnValue) {
            $returnValue .= $rule[$i];
            continue;
        }

        $argument .= $rule[$i];
    }

    return function (array $part) use ($conditionals, $argument, $rule) {
        $returnValues = [];
        foreach ($conditionals as $conditional) {
            // false, true
            [$false, $true] = $conditional($part);

            $part = $false[0];

            $returnValues = [...$returnValues, ...$true];
        }

        $returnValues[$argument] = $false[0];

        return $returnValues;
    };
}

function processPart(array $part, array $workflows, string $name): int {
    $workflow = $workflows[$name];
    $outcome = $workflow($part);
    $count = 0;
    $i = 0;
    foreach ($outcome as $result => $splitPart) {
        $i++;
        if ($result === 'A') {
            var_dump($splitPart);
            $x = ($splitPart['x'][1] - $splitPart['x'][0]) + 1;
            $m = ($splitPart['m'][1] - $splitPart['m'][0]) + 1;
            $a = ($splitPart['a'][1] - $splitPart['a'][0]) + 1;
            $s = ($splitPart['s'][1] - $splitPart['s'][0]) + 1;

            $count += $x * $m * $a * $s;

            continue;
        }

        if ($result !== 'R') {
            $count += processPart($splitPart, $workflows, $result);
        }
    }

    return $count;
}
