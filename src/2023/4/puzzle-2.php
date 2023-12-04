<?php

require_once('helpers.php');

$cards = parseInput();

$matches = [];
$countMatches = fn(array $a, array $b) => count(array_intersect($a, $b));
foreach ($cards as $id => [$drawnNumbers, $winningNumbers]) {
    $count = $countMatches($drawnNumbers, $winningNumbers);
    $matches[$id] = $count !== 0 ? array_filter(range($id + 1, $id + $count), fn(int $i) => isset($cards[$i])) : [];
}

$result = count($cards);
foreach ($matches as $id => $match) {
    $result += countCards($matches, $id);
}

var_dump($result);
var_dump($result === 11787590); // 11787590
var_dump(memory_get_peak_usage());