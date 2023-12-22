<?php

namespace AdventOfCode\Day20;

class Broadcaster extends Module
{
    protected static string $type = 'broadcaster';

    public function handlePulse(Pulse $pulse): array
    {
        $pulses = [];
        foreach ($this->receivers as $receiver) {
            $pulses[] = new Pulse($pulse->value, $this->id, $receiver);
        }

        return $pulses;
    }
}
