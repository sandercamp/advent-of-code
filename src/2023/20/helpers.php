<?php

namespace AdventOfCode\Day20;

function parseInput(): Configuration {
    $input = file('input.txt');

    $configuration = new Configuration();
    foreach ($input as $module) {
        [$module, $receivers] = explode('->', $module);

        $module = $configuration->createModule(trim($module)[0], substr(trim($module), 1));

        $receivers = explode(', ', trim($receivers));

        $module->setReceivers($receivers);
    }

    /** @var Conjunction $conjunction */
    foreach ($configuration->findByType('&') as $conjunction) {
        $senders = [];

        foreach ($configuration->getModules() as $module) {
            if (in_array($conjunction->getId(), $module->getReceivers())) {
                $senders[] = $module->getId();
            }
        }

        $conjunction->setSenders($senders);
    }

    return $configuration;
}
