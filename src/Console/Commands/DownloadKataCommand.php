<?php

namespace ImprovePhp\KaataaCore\Console\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DownloadKataCommand extends BaseCommand
{
    private $name;

    protected static $defaultName = 'download:kata';

    protected function configure(): void
    {
        $this->setDescription('Download a kata')
            ->setHelp('Download a kata from web')
            ->addArgument(
                'name',
                $this->name ? InputArgument::REQUIRED : InputArgument::OPTIONAL,
                'Specify id of kata',
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($name = $input->getArgument('name')) {
            return $this->downloadFiles($output, $name);
        }

        return $this->invalid($output, 'Please specify id of kata');
    }

    public function downloadFiles(OutputInterface $output, $name)
    {
        $result = $this->downloadKata($name, $output);

        if ($result) {
            $this->success($output);

            return $this->successResult();
        }

        return $this->error($output);
    }

    public function downloadKata(string $id, OutputInterface $output)
    {
        $this->success($output, 'Downloading kata...');

        return true;
    }
}
