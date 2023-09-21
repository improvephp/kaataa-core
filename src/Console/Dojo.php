<?php

namespace SebaCarrasco93\KaataaCore\Console;

use SebaCarrasco93\KaataaCore\Console\Commands\CreateKataCommand;
use SebaCarrasco93\KaataaCore\Console\Commands\MakeClassCommand;
use SebaCarrasco93\KaataaCore\Console\Commands\MakeTestCommand;
use Symfony\Component\Console\Application;

class Dojo
{
    public static function addCommands(array $commands)
    {
        $application = new Application();

        foreach ($commands as $command) {
            $application->add(new $command());
        }

        $application->run();
    }

    public static function start()
    {
        self::addCommands([
            CreateKataCommand::class,
            MakeClassCommand::class,
            MakeTestCommand::class,
        ]);
    }
}
