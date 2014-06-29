<?php

namespace Haphan\Rage4DNS\Command\Domains;

use Haphan\Rage4DNS\Command\Command;
use Haphan\Rage4DNS\Entity\Status;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class UpdateDomainCommand
 *
 * @package Haphan\Rage4DNS\Command\Domains
 */
class UpdateDomainCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('domains:update')
            ->setDescription('Update a domain.')
            ->addArgument('id', InputArgument::REQUIRED, 'ID of domain.')
            ->addArgument('email', InputArgument::REQUIRED, 'Email of owner.')
            ->addArgument('nsname', InputArgument::REQUIRED, 'Vanity NS domain name.')
            ->addArgument('nsprefix', InputArgument::REQUIRED, 'Vanity NS perfix.')
            ->addArgument('enablevanity', InputArgument::REQUIRED, 'Activate vanity domain name.')
            ->addOption('credentials', null, InputOption::VALUE_REQUIRED,
                'If set, the yaml file which contains your credentials', Command::DEFAULT_CREDENTIALS_FILE);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rage4 = $this->getRage4DNS($input->getOption('credentials'));

        $status = $rage4->domains->updateDomain(
            $input->getArgument('id'),
            $input->getArgument('email'),
            $input->getArgument('nsname'),
            $input->getArgument('nsprefix'),
            $input->getArgument('enablevanity')
        );

        $content[] = $status->getTableRow();

        $this->renderTable(
            Status::getTableHeaders(),
            $content,
            $output
        );
    }
}
