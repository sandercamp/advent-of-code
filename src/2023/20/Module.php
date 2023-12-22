<?php

namespace AdventOfCode\Day20;

abstract class Module
{
    protected string $id;
    protected array $receivers = [];

    protected static string $type = '';

    public function __construct(string $id, array $receivers)
    {
        $this->id = $id;
        $this->receivers = $receivers;
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string[]
     */
    public function getReceivers(): array
    {
        return $this->receivers;
    }

    public function setReceivers(array $receivers): void
    {
        $this->receivers = $receivers;
    }

    public abstract function handlePulse(Pulse $pulse): array;

    public function isType(string $type): bool
    {
        return $type === $this::$type;
    }
}
