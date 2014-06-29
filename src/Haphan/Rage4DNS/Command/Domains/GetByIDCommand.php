<?php

namespace Haphan\Rage4DNS\Command\Domains;

use Haphan\Rage4DNS\Command\Command;
use Haphan\Rage4DNS\Entity\Domain;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GetByIDCommand
 *
 * @package Haphan\Rage4DNS\Command\Domains
 */
class GetByIDCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('domains:id')
            ->setDescription('Get domain by id.')
            ->addArgument('id', InputArgument::REQUIRED, 'ID of domain')
            ->addOption('credentials', null, InputOption::VALUE_REQUIRED,
                'If set, the yaml file which contains your credentials', Command::DEFAULT_CREDENTIALS_FILE);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rage4 = $this->getRage4DNS($input->getOption('credentials'));

        $domain = $rage4->domains->getById($input->getArgument('id'));

        $content[0] =  $domain->getTableRow();

        $this->renderTable(
            Domain::getTableHeaders(),
            $content,
            $output
        );
    }
}
