<?php

namespace Haphan\Rage4DNS\Command\Domains;

use Haphan\Rage4DNS\Command\Command;
use Haphan\Rage4DNS\Entity\Status;
use Symfony\Component\Console\Helper\TableHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class DeleteDomainCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('domains:delete')
            ->setDescription('Delete a domain.')
            ->addArgument('id', InputArgument::REQUIRED, 'ID of domain')
            ->addOption('credentials', null, InputOption::VALUE_REQUIRED,
                'If set, the yaml file which contains your credentials', Command::DEFAULT_CREDENTIALS_FILE);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rage4 = $this->getRage4DNS($input->getOption('credentials'));

        $status = $rage4->domains->deleteDomain(
            $input->getArgument('id')
        );

        $content[] = $status->toArray();

        $this->renderTable(
            Status::getColumnHeaders(),
            $content,
            $output
        );
    }
}