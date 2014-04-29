<?php

namespace Haphan\Rage4DNS\Command\Domains;

use Haphan\Rage4DNS\Command\Command;
use Haphan\Rage4DNS\Entity\Domain;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GetAllCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('domains:all')
            ->setDescription('List all registered domains.')
            ->addOption('credentials', null, InputOption::VALUE_REQUIRED,
                'If set, the yaml file which contains your credentials', Command::DEFAULT_CREDENTIALS_FILE);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rage4 = $this->getRage4DNS($input->getOption('credentials'));

        $domains = $rage4->domains->getAll();

        $content = array();

        foreach ($domains as $domain) {
            $content[] = $domain->getTableRow();
        }

        $this->renderTable(Domain::getTableHeaders(), $content, $output);
    }
}
