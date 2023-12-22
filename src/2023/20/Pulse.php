<?php

namespace AdventOfCode\Day20;

class Pulse
{
    public int $value;
    public string $sender;
    public string $receiver;

    public function __construct(int $value, string $sender, string $receiver)
    {
        $this->value = $value;
        $this->sender = $sender;
        $this->receiver = $receiver;
    }
}
