<?php

namespace AdventOfCode\Day20;

class Configuration
{
    /** @var Module[] */
    private array $modules = [];
    private array $queue = [];
    private int $lowPulses = 0;
    private int $highPulses = 0;
    private int $buttonPresses = 0;

    public function pressButton(): void
    {
        $this->buttonPresses++;
    }

    public function createModule(string $type, string $id): Module {
        switch ($type) {
            case '%':
                $module = new FlipFlop($id, []);
                break;
            case '&':
                $module = new Conjunction($id, []);
                break;
            default:
                $module = new Broadcaster('broadcaster', []);
        }

        $this->modules[$module->getId()] = $module;

        return $module;
    }

    public function getModule(string $id): Module
    {
        if (isset($this->modules[$id])) {
            return $this->modules[$id];
        }

        return new BlackHole('', []);
    }

    public function handlePulse(Pulse $pulse): void
    {
        if ($pulse->value === 0) {
            $this->lowPulses++;
        } else {
            $this->highPulses++;
        }

//        var_dump(
//            sprintf(
//                'From %s to %s with value %s',
//                $pulse->sender,
//                $pulse->receiver,
//                $pulse->value === 1 ? 'high' : 'low'
//            )
//        );

        if ($pulse->receiver === 'rx' && $pulse->value === 0) {
            var_dump($pulse);die;
        }

        $pulses = $this->getModule($pulse->receiver)->handlePulse($pulse);

        /** @var Conjunction $con */
        $con = $this->getModule('vf');
        if ($pulse->receiver === 'vf' && array_sum($con->getSenders()) > 0) {
            var_dump($this->buttonPresses);
            var_dump($con->getSenders());
        }

        $this->queue = [...$this->queue, ...$pulses];

        while (!empty($this->queue)) {
            $current = array_shift($this->queue);

            $this->handlePulse($current);
        }
    }

    public function countLowPulses(): int
    {
        return $this->lowPulses;
    }

    public function countHighPulses(): int
    {
        return $this->highPulses;
    }

    /**
     * @return Module[]
     */
    public function findByType(string $type): array {
        $modules = [];
        foreach ($this->modules as $module) {
            if ($module->isType($type)) {
                $modules[] = $module;
            }
        }

        return $modules;
    }

    /**
     * @return Module[]
     */
    public function getModules(): array
    {
        return $this->modules;
    }
}