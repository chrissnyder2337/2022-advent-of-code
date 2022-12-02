<?php declare(strict_types=1);

namespace AdventOfCode;

use Symfony\Component\Console\Application;

class App extends Application {

    public function __construct(iterable $commands) {
        $commands = $commands instanceof \Traversable
          ? \iterator_to_array($commands,false)
          : $commands;

        foreach ($commands as $command) {
            $this->add($command);
        }

        parent::__construct();
    }
}