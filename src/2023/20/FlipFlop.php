<?php

namespace AdventOfCode\Day20;

class FlipFlop extends Module
{
    protected static string $type = '%';
    private int $state = 0;

    public function handlePulse(Pulse $pulse): array {
        if ($pulse->value === 1) {
            return [];
        }

        $this->state = $this->state === 0 ? 1 : 0;

        $pulses = [];
        foreach ($this->receivers as $receiver) {
            $pulses[] = new Pulse($this->state, $this->id, $receiver);
        }

        return $pulses;
    }
}
