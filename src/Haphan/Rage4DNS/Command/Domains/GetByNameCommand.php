<?php

namespace Haphan\Rage4DNS\Command\Domains;

use Haphan\Rage4DNS\Command\Command;
use Haphan\Rage4DNS\Entity\Domain;
use Symfony\Component\Console\Helper\TableHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class GetByNameCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('domains:name')
            ->setDescription('Get domain by name.')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of domain. For example: abc.com')
            ->addOption('credentials', null, InputOption::VALUE_REQUIRED,
                'If set, the yaml file which contains your credentials', Command::DEFAULT_CREDENTIALS_FILE);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rage4 = $this->getRage4DNS($input->getOption('credentials'));

        $domain = $rage4->domains->getByName($input->getArgument('name'));

        $content[0] =  $domain->getTableRow();

        $this->renderTable(
            Domain::getTableHeaders(),
            $content,
            $output
        );
    }
}