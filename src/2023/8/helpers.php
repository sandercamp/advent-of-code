<?php

function parseInput(): array {
    [$instructions, $maps] = preg_split("#\n\s*\n#Uis", file_get_contents('./input.txt'));

    $instructions = str_split(str_replace(['L', 'R'], [0, 1], trim($instructions)));

    $parsedMaps = [];
    $startingNodes = [];
    foreach (preg_split("/\r\n|\n|\r/", $maps) as $map) {
        $identifier = substr($map, 0, 3);
        $left = substr($map, 7, 3);
        $right = substr($map, 12, 3);
        $parsedMaps[$identifier] = [$left, $right];

        if (strpos($identifier, 'A', 2)) {
            $startingNodes[] = $identifier;
        }
    }

    return [$instructions, $parsedMaps, $startingNodes];
}