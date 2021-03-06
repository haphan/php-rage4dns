<?php

/**
 * This file is part of the haphan/php-rage4-dns-api Library.
 *
 * (c) Ha Phan <http://github.com/haphan>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Haphan\Rage4DNS\API;

use Haphan\Rage4DNS\AbstractRage4DNS;
use Haphan\Rage4DNS\Credentials;
use Haphan\Rage4DNS\Entity\DomainUsageHistory;
use Haphan\Rage4DNS\Entity\GlobalUsageHistory;

/**
 * Class Usage
 *
 * @package Haphan\Rage4DNS\API
 */
class Usage extends AbstractRage4DNS
{

    const URL_GLOBAL_USAGE = 'showcurrentglobalusage';
    const URL_CURRENT_USAGE = 'showcurrentusage';

    /**
     * @param Credentials $credentials
     */
    public function __construct(Credentials $credentials)
    {
        parent::__construct($credentials);
    }

    /**
     * Returns global usages of all domains
     *
     * Order by date desc.
     *
     * @return GlobalUsageHistory
     */
    public function getGlobalUsage()
    {
        $url = sprintf("%s/%s/", $this->apiUrl, self::URL_GLOBAL_USAGE);

        $response =  $this->processQuery($url);

        $usages = array();

        foreach ($response as $row) {
            $usages[] = GlobalUsageHistory::createFromArray($row);
        }

        return array_reverse($usages);
    }

    /**
     * Returns usage of given domain.
     *
     * Order by date desc.
     *
     * @param int $id Domain ID
     *
     * @return DomainUsageHistory[]
     */
    public function getCurrentUsage($id)
    {
        $url = sprintf("%s/%s/%d", $this->apiUrl, self::URL_CURRENT_USAGE, $id);

        $response =  $this->processQuery($url);

        $usages = array();

        foreach ($response as $row) {
            $usages[] = DomainUsageHistory::createFromArray($row);
        }

        return array_reverse($usages);
    }
}
