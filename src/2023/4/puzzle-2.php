<?php

require_once('helpers.php');

$input = parseInput();

$matches = [];
$countMatches = fn(array $a, array $b) => count(array_intersect($a, $b));
foreach ($input as $id => [$drawnNumbers, $winningNumbers]) {
    $count = $countMatches($drawnNumbers, $winningNumbers);
    $matches[$id] = [
        'id' => $id,
        'count' => $countMatches($drawnNumbers, $winningNumbers),
        'keys' => $count !== 0 ? array_filter(range($id + 1, $id + $count), fn(int $i) => isset($input[$i])) : []
    ];
}

$result = count($matches) + array_reduce(
    $matches,
    fn(int $carry, array $match) => $carry + ($match['count'] > 0 ? countCards($matches, $match['id']) : 0),
    0
);

var_dump($result);
var_dump($result === 11787590); // 11787590
var_dump(memory_get_peak_usage());