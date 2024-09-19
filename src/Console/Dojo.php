<?php

namespace ImprovePhp\KaataaCore\Console;

use ImprovePhp\KaataaCore\Console\Commands\CreateKataCommand;
use ImprovePhp\KaataaCore\Console\Commands\DownloadKataCommand;
use ImprovePhp\KaataaCore\Console\Commands\MakeClassCommand;
use ImprovePhp\KaataaCore\Console\Commands\MakeTestCommand;
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
            DownloadKataCommand::class,
            MakeClassCommand::class,
            MakeTestCommand::class,
        ]);
    }
}
