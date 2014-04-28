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
        $domainID = $input->getArgument('id');

        $confirmation = $this->getHelperSet()->get('dialog')->askConfirmation(
            $output,
            sprintf('<question>Are you sure to delete domain with id %d ? (y/N)</question> ',
                $domainID),
            false
        );

        if($input->getOption('no-interaction'))
        {
            $confirmation = true;
        }

        if(false === $confirmation)
        {
            return;
        }

        $rage4 = $this->getRage4DNS($input->getOption('credentials'));

        $status = $rage4->domains->deleteDomain($domainID);

        $content[] = $status->getTableRow();

        $this->renderTable(
            Status::getTableHeaders(),
            $content,
            $output
        );
    }
}