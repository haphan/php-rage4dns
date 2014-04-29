<?php

namespace Haphan\Rage4DNS\Command\Records;

use Haphan\Rage4DNS\Command\Command;
use Haphan\Rage4DNS\Entity\Record;
use Haphan\Rage4DNS\Entity\Status;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateRecordCommand extends Command
{

    protected function configure()
    {
        parent::configure();

        $this
            ->setName('records:update')
            ->setDescription('Update a record.');

        $this
            ->addArgument('id', InputArgument::REQUIRED, 'Record ID.')
            ->addArgument('name', InputArgument::REQUIRED, 'Record name. Example: dev.example.com.')
            ->addArgument('content', InputArgument::REQUIRED, 'Record value. Example: 8.8.8.8')
            ->addArgument('type', InputArgument::REQUIRED, 'Record Type. Example: A');

        $this
            ->addOption('priority', 'p', InputOption::VALUE_REQUIRED, 'Record priority. Example: 1.', null)
            ->addOption('enable-failover', 'f', InputOption::VALUE_NONE, 'Use this flag to enable fail-over.')
            ->addOption('failover-content', 'fc', InputOption::VALUE_REQUIRED, 'Value of fail-over record.')
            ->addOption('ttl', 't', InputOption::VALUE_REQUIRED, 'TTL')
            ->addOption('geozone', 'g', InputOption::VALUE_REQUIRED, 'Geo Zone ID. See records:regions for available zones.')
            ->addOption('lock-geo', 'l',  InputOption::VALUE_NONE , 'Use this flag to lock geo.')
            ->addOption('geo-long', 'lo', InputOption::VALUE_REQUIRED, 'Geo longitude')
            ->addOption('geo-lat', 'la', InputOption::VALUE_REQUIRED, 'Geo latitude');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rage4 = $this->getRage4DNS($input->getOption('credentials'));

        $record = new Record();
        $record->setId($input->getArgument('id'));
        $record->setName($input->getArgument('name'));
        $record->setContent($input->getArgument('content'));
        $record->setType($input->getArgument('type'));

        $record->setPriority($input->getOption('priority'));
        $record->setFailoverEnabled($input->getOption('enable-failover') ? true : false);
        $record->setFailoverContent($input->getOption('failover-content'));
        $record->setTtl($input->getOption('ttl'));
        $record->setGeoRegionId($input->getOption('geozone'));
        $record->setGeoLock($input->getOption('lock-geo') ? true : false);
        $record->setGeoLong($input->getOption('geo-long'));
        $record->setGeoLat($input->getOption('geo-lat'));

        $status = $rage4->records->updateRecord($record);

        $content[] = $status->getTableRow();

        $this->renderTable(
            Status::getTableHeaders(),
            $content,
            $output
        );
    }
}
