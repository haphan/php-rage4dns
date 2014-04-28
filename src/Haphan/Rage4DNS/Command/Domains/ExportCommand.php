<?php

namespace Haphan\Rage4DNS\Command\Domains;

use Haphan\Rage4DNS\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class ExportCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('domains:export')
            ->setDescription('Export zones as BIND compatible file format')
            ->addArgument('id', InputArgument::REQUIRED, 'ID of domain')
            ->addOption('credentials', null, InputOption::VALUE_REQUIRED,
                'If set, the yaml file which contains your credentials', Command::DEFAULT_CREDENTIALS_FILE);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rage4 = $this->getRage4DNS($input->getOption('credentials'));

        $zone = $rage4->domains->exportZone(
            $input->getArgument('id')
        );

        $output->writeln($zone);
    }
}