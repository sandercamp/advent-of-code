<?php

function parseInput(): array {
    $lines = file('src/2023/4/input.txt');

    $parsedInput = [];
    foreach ($lines as $line) {
        [$identifier, $numbers] = explode(':', $line);
        [$drawnNumbers, $winningNumbers] = explode('|', $numbers);

        $parsedInput[filter_var($identifier, FILTER_SANITIZE_NUMBER_INT)] = [
            array_filter(explode(' ', trim($drawnNumbers))),
            array_filter(explode(' ', trim($winningNumbers)))
        ];
    }

    return $parsedInput;
}

function doubleConsecutive(int $n): int {
    return $n === 0
        ? 0
        : array_reduce(
            array_fill(0, $n - 1, null),
            fn(int $carry) => $carry * 2,
            1
        );
}

class CardCounter {
    private array $referenceMap = [];
    private array $cards;

    public function __construct(array $cards)
    {
        $this->cards = $cards;
    }

    public function countCards(int $id): int {
        if ($this->referenceExists($id)) {
            return $this->referenceMap[$id];
        }

        $result = count($this->cards[$id]);
        foreach ($this->cards[$id] as $key) {
            $result += $this->countCards($key);
        }

        $this->referenceMap[$id] = $result;

        return $result;
    }

    private function referenceExists(int $id): bool
    {
        return isset($this->referenceMap[$id]);
    }
}
