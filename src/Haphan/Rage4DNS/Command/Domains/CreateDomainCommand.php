<?php

namespace Haphan\Rage4DNS\Command\Domains;

use Haphan\Rage4DNS\Command\Command;
use Haphan\Rage4DNS\Entity\Status;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CreateDomainCommand
 *
 * @package Haphan\Rage4DNS\Command\Domains
 */
class CreateDomainCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('domains:create')
            ->setDescription('Create regular domain.')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of domain. For example: abc.com')
            ->addArgument('email', InputArgument::REQUIRED, 'Email of owner.')
            ->addOption('credentials', null, InputOption::VALUE_REQUIRED,
                'If set, the yaml file which contains your credentials', Command::DEFAULT_CREDENTIALS_FILE);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rage4 = $this->getRage4DNS($input->getOption('credentials'));

        $status = $rage4->domains->createDomain($input->getArgument('name'), $input->getArgument('email'));

        $content[] = $status->getTableRow();

        $this->renderTable(
            Status::getTableHeaders(),
            $content,
            $output
        );
    }
}
