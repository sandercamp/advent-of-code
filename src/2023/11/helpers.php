<?php

function parseInput(): array {
    return file('input.txt');
}

function shortestPath(array $graph, array $vertices)
{
    $INF = PHP_INT_MAX;

    $dist = array_fill(0, count($graph), array_fill(0, count($graph[0]), 0));


}
