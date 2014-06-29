<?php

namespace Haphan\Rage4DNS\Command\Records;

use Haphan\Rage4DNS\Command\Command;
use Haphan\Rage4DNS\Entity\Status;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DeleteRecordCommand
 *
 * @package Haphan\Rage4DNS\Command\Records
 */
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
        $recordID = $input->getArgument('id');

        $confirmation = $this->getHelperSet()->get('dialog')->askConfirmation(
            $output,
            sprintf('<question>Are you sure to delete record with id %d ? (y/N)</question> ',
                $recordID),
            false
        );

        if ($input->getOption('no-interaction')) {
            $confirmation = true;
        }

        if (false === $confirmation) {
            return;
        }

        $rage4 = $this->getRage4DNS($input->getOption('credentials'));

        $status = $rage4->records->deleteRecord($recordID);

        $content[] = $status->getTableRow();

        $this->renderTable(
            Status::getTableHeaders(),
            $content,
            $output
        );
    }
}
