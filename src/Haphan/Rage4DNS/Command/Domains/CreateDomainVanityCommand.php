<?php

namespace Haphan\Rage4DNS\Command\Domains;

use Haphan\Rage4DNS\Command\Command;
use Haphan\Rage4DNS\Entity\Domain;
use Haphan\Rage4DNS\Entity\Status;
use Symfony\Component\Console\Helper\TableHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class CreateDomainVanityCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('domains:createVanity')
            ->setDescription('Create regular domain with vanity name server.')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of domain. For example: abc.com')
            ->addArgument('email', InputArgument::REQUIRED, 'Email of owner.')
            ->addArgument('nsname', InputArgument::REQUIRED, 'Vanity NS domain name.')
            ->addArgument('nsprefix', InputArgument::OPTIONAL, 'Vanity NS perfix. Default to ns', 'ns')
            ->addOption('credentials', null, InputOption::VALUE_REQUIRED,
                'If set, the yaml file which contains your credentials', Command::DEFAULT_CREDENTIALS_FILE);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rage4 = $this->getRage4DNS($input->getOption('credentials'));

        $status = $rage4->domains->createDomainVanity(
            $input->getArgument('name'),
            $input->getArgument('email'),
            $input->getArgument('nsname'),
            $input->getArgument('nsprefix')
        );

        $content[] = $status->getTableRow();

        $this->renderTable(
            Status::getTableHeaders(),
            $content,
            $output
        );
    }
}