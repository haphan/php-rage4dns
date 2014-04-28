<?php
/**
 * (c) Ha Phan <thanhha.work@gmail.com>
 * Date: 4/26/14
 * Time: 9:23 AM
 */

namespace Haphan\Rage4DNS\Command\Usage;

use Haphan\Rage4DNS\Command\Command;
use Haphan\Rage4DNS\Entity\GlobalUsageHistory;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class GlobalUsageCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('usage:global')
            ->setDescription('Retrieve global usage.')
            ->addOption('limit', 'l', InputOption::VALUE_OPTIONAL, 'Limit number of history rows. 0 to display all', '15')
            ->addOption('credentials', null, InputOption::VALUE_REQUIRED,
                'If set, the yaml file which contains your credentials', Command::DEFAULT_CREDENTIALS_FILE);
    }



    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rage4 = $this->getRage4DNS($input->getOption('credentials'));

        $globalUsage = $rage4->usage->getGlobalUsage();

        $content = array();

        foreach ($globalUsage as $record) {
            $content[] = $record->getTableRow();
        }

        $limit = $input->getOption('limit');

        if($limit > 0)
        {
            $content = array_slice($content, 0,$limit);
        }

        $this->renderTable(
            GlobalUsageHistory::getTableHeaders(),
            $content,
            $output
        );
    }
}