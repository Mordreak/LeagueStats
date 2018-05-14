<?php

namespace LSTATS\RiotBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class RefreshRealmsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:refresh-realms')

            // the short description shown while running "php bin/console list"
            ->setDescription('refreshs league of legends realms')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to manually refresh all league of legends realms')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Realms Refresh',
            '============',
            '',
        ]);

        $this->getContainer()->get('lstats_riot.summoners')->refreshRealms($output);

        $output->writeln([
            '',
            '============',
            'Done'
        ]);
    }
}