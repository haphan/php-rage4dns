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
use Haphan\Rage4DNS\Entity\Record;
use Haphan\Rage4DNS\Entity\RecordType;
use Haphan\Rage4DNS\Entity\Region;
use Haphan\Rage4DNS\Entity\Status;

/**
 * Class Records
 *
 * @package Haphan\Rage4DNS\API
 */
class Records extends AbstractRage4DNS
{

    const URL_RECORD_TYPES = 'listrecordtypes';
    const URL_REGIONS = 'listgeoregions';
    const URL_RECORDS = 'getrecords';
    const URL_CREATE_RECORD = 'createrecord';
    const URL_UPDATE_RECORD = 'updaterecord';
    const URL_DELETE_RECORD = 'deleterecord';
    const URL_FAIL_OVER_RECORD = 'setrecordfailover';

    /**
     * @param Credentials $credentials
     */
    public function __construct(Credentials $credentials)
    {
        parent::__construct($credentials);
    }

    /**
     * Returns available record types
     *
     * @return RecordType[]
     */
    public function getTypes()
    {
        $url = sprintf("%s/%s", $this->apiUrl, self::URL_RECORD_TYPES);

        $response =  $this->processQuery($url);

        $types = array();

        foreach ($response as $row) {
            $types[]  = RecordType::createFromArray($row);
        }

        return $types;
    }

    /**
     * Returns available geo regions
     *
     * @return Region[]
     */
    public function getRegions()
    {
        $url = sprintf("%s/%s", $this->apiUrl, self::URL_REGIONS);

        $response =  $this->processQuery($url);

        $regions = array();

        foreach ($response as $row) {
            $regions[]  = Region::createFromArray($row);
        }

        return $regions;
    }

    /**
     * @param int $recordID
     *
     * @return array
     */
    public function getRecords($recordID)
    {
        $url = sprintf("%s/%s/%d", $this->apiUrl, self::URL_RECORDS, $recordID);

        $response = $this->processQuery($url);

        $records = array();

        foreach ($response as $row) {
            $records[]  = Record::createFromArray($row);
        }

        return $records;
    }

    /**
     * @param Record $record
     *
     * @return Status
     * @throws \Exception
     */
    public function createRecord(Record $record)
    {
        $domainID = $record->getDomainId();

        if (!$domainID) {
            throw new \Exception('Cannot create record. Domain ID is missing');
        }
        $url = sprintf("%s/%s/%d", $this->apiUrl, self::URL_CREATE_RECORD, $domainID);

        $response = $this->processQuery($url, null, array(
                'query' => $record->toArray()
            ));

        return Status::createFromArray($response);
    }

    /**
     * @param Record $record
     *
     * @return Status
     * @throws \Exception
     */
    public function updateRecord(Record $record)
    {
        if (!$record->getId()) {
            throw new \Exception('Cannot create record. Record ID is missing');
        }

        $url = sprintf("%s/%s/%d", $this->apiUrl, self::URL_UPDATE_RECORD, $record->getId());

        $response = $this->processQuery($url, null, array(
                'query' => $record->toArray()
            ));

        return Status::createFromArray($response);
    }

    /**
     * @param int $recordID
     *
     * @return Status
     */
    public function deleteRecord($recordID)
    {
        $url = sprintf("%s/%s/%d", $this->apiUrl, self::URL_DELETE_RECORD, $recordID);

        $response = $this->processQuery($url);

        return Status::createFromArray($response);
    }

}
