<?php

namespace Haphan\Rage4DNS\Command\Records;

use Haphan\Rage4DNS\Command\Command;
use Haphan\Rage4DNS\Entity\Record;
use Haphan\Rage4DNS\Entity\RecordType;
use Haphan\Rage4DNS\Entity\Region;
use Haphan\Rage4DNS\Entity\Status;
use Symfony\Component\Console\Helper\TableHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class DeleteRecordCommand extends Command
{

    protected function configure()
    {
        parent::configure();

        $this
            ->setName('records:delete')
            ->setDescription('Delete a record.');

        $this->addArgument('id', InputArgument::REQUIRED, 'Record ID.');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rage4 = $this->getRage4DNS($input->getOption('credentials'));

        $status = $rage4->records->deleteRecord($input->getArgument('id'));

        $content[] = $status->getTableRow();

        $this->renderTable(
            Status::getTableHeaders(),
            $content,
            $output
        );
    }
}