<?php

namespace Haphan\Rage4DNS\Command\Records;

use Haphan\Rage4DNS\Command\Command;
use Haphan\Rage4DNS\Entity\Record;
use Haphan\Rage4DNS\Entity\Status;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateRecordCommand extends Command
{

    protected function configure()
    {
        parent::configure();

        $this
            ->setName('records:create')
            ->setDescription('Create a record.');

        $this
            ->addArgument('id', InputArgument::REQUIRED, 'Domain ID.')
            ->addArgument('name', InputArgument::REQUIRED, 'Record name. Example: dev.example.com.')
            ->addArgument('content', InputArgument::REQUIRED, 'Record value. Example: 8.8.8.8')
            ->addArgument('type', InputArgument::REQUIRED, 'Record Type. Example: A')
            ->addArgument('ttl', InputArgument::OPTIONAL, 'TTL', 3600)
            ->addArgument('geozone', InputArgument::OPTIONAL, 'Geo Zone ID. See records:regions for available zones.', 'null');
        $this
            ->addOption('priority', 'p', InputOption::VALUE_REQUIRED, 'Record priority. Example: 1.', null)
            ->addOption('enable-failover', 'f', InputOption::VALUE_NONE, 'Use this flag to enable fail-over.')
            ->addOption('failover-content', 'fc', InputOption::VALUE_REQUIRED, 'Value of fail-over record.')
            ->addOption('lock-geo', 'l',  InputOption::VALUE_NONE , 'Use this flag to lock geo.')
            ->addOption('geo-long', 'lo', InputOption::VALUE_REQUIRED, 'Geo longitude')
            ->addOption('geo-lat', 'la', InputOption::VALUE_REQUIRED, 'Geo latitude');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rage4 = $this->getRage4DNS($input->getOption('credentials'));

        $record = new Record();
        $record->setDomainId($input->getArgument('id'));
        $record->setName($input->getArgument('name'));
        $record->setContent($input->getArgument('content'));
        $record->setType($input->getArgument('type'));
        $record->setTtl($input->getArgument('ttl'));
        $record->setGeoRegionId($input->getArgument('geozone'));

        $record->setPriority($input->getOption('priority'));
        $record->setFailoverEnabled($input->getOption('enable-failover') ? true : false);
        $record->setFailoverContent($input->getOption('failover-content'));

        $record->setGeoLock($input->getOption('lock-geo') ? true : false);
        $record->setGeoLong($input->getOption('geo-long'));
        $record->setGeoLat($input->getOption('geo-lat'));

        $status = $rage4->records->createRecord($record);

        $content[] = $status->getTableRow();

        $this->renderTable(
            Status::getTableHeaders(),
            $content,
            $output
        );
    }
}
