<?php

namespace Haphan\Rage4DNS\Command;

use Haphan\Rage4DNS\Rage4DNS;
use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;
use Haphan\Rage4DNS\Credentials;

class Command extends BaseCommand
{
    /**
     * The distribution file with fake credentials.
     *
     * @var string
     */
    const DIST_CREDENTIALS_FILE = './credentials.yml.dist';

    /**
     * The default file with credentials.
     *
     * @var string
     */
    const DEFAULT_CREDENTIALS_FILE = './credentials.yml';

    /**
     * Returns an instance of Rage4DNS API client
     *
     * @param string $file
     * @return \Haphan\Rage4DNS\Rage4DNS
     * @throws \RuntimeException
     */
    public function getRage4DNS($file = self::DEFAULT_CREDENTIALS_FILE)
    {
        if (!file_exists($file)) {
            throw new \RuntimeException(sprintf('Impossible to get credentials informations in %s', $file));
        }

        $credentials = Yaml::parse($file);

        return new Rage4DNS(new Credentials($credentials['email'], $credentials['api_key']));

    }

    protected function renderTable($headers, array $content, OutputInterface $output)
    {
        $table = $this->getHelperSet()->get('table');
        $table
            ->setHeaders($headers)
            ->setRows($content);

        $table->render($output);

    }
}