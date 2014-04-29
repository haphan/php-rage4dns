<?php

namespace Haphan\Rage4DNS\Command\Records;

use Haphan\Rage4DNS\Command\Command;
use Haphan\Rage4DNS\Entity\Record;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GetRecordsCommand extends Command
{

    protected function configure()
    {
        parent::configure();

        $this
            ->setName('records:all')
            ->setDescription('List all records for specific domain.')
            ->addOption('full', null, InputOption::VALUE_NONE, 'Display all properties of records.')
            ->addArgument('id', InputArgument::REQUIRED, 'ID of domain.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rage4 = $this->getRage4DNS($input->getOption('credentials'));

        $records = $rage4->records->getRecords(
            $input->getArgument('id')
        );

        $full = $input->getOption('full');

        $content = array();

        foreach ($records as $type) {
            $content[] = $type->getTableRow($full);
        }

        $this->renderTable(
            Record::getTableHeaders($full),
            $content,
            $output
        );
    }
}
