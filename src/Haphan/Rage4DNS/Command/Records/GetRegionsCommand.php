<?php

namespace Haphan\Rage4DNS\Command\Records;

use Haphan\Rage4DNS\Command\Command;
use Haphan\Rage4DNS\Entity\Region;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetRegionsCommand extends Command
{

    protected function configure()
    {
        parent::configure();

        $this
            ->setName('records:regions')
            ->setDescription('Display all geo regions.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rage4 = $this->getRage4DNS($input->getOption('credentials'));

        $regions = $rage4->records->getRegions();

        $content = array();

        foreach ($regions as $type) {
            $content[] = $type->getTableRow();
        }

        $this->renderTable(
            Region::getTableHeaders(),
            $content,
            $output
        );
    }
}
