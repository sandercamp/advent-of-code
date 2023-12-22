<?php

namespace AdventOfCode\Day20;

class Conjunction extends Module
{
    protected static string $type = '&';
    private array $senders = [];

    public function handlePulse(Pulse $pulse): array {
        $this->senders[$pulse->sender] = $pulse->value;

        $value = array_sum($this->senders) === count($this->senders) ? 0 : 1;

        $pulses = [];
        foreach ($this->receivers as $receiver) {
            $pulses[] = new Pulse($value, $this->id, $receiver);
        }

        return $pulses;
    }

    /**
     * @param int[] $senders
     */
    public function setSenders(array $senders): void
    {
        $this->senders = array_fill_keys($senders, 0);
    }

    /**
     * @return string[]
     */
    public function getSenders(): array
    {
        return $this->senders;
    }
}
