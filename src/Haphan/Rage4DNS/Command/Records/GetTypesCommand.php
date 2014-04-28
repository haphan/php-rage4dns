<?php

namespace Haphan\Rage4DNS\Command\Records;

use Haphan\Rage4DNS\Command\Command;
use Haphan\Rage4DNS\Entity\RecordType;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class GetTypesCommand extends Command
{

    protected function configure()
    {
        parent::configure();

        $this
            ->setName('records:types')
            ->setDescription('Display all available record types.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rage4 = $this->getRage4DNS($input->getOption('credentials'));

        $types = $rage4->records->getTypes();

        $content = array();

        foreach ($types as $type) {
            $content[] = $type->getTableRow();
        }

        $this->renderTable(
            RecordType::getTableHeaders(),
            $content,
            $output
        );
    }
}