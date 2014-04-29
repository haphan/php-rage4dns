<?php
/**
 * (c) Ha Phan <thanhha.work@gmail.com>
 * Date: 4/26/14
 * Time: 8:04 AM
 */

namespace Haphan\Rage4DNS\Entity;

/**
 * Class Record represents a dns record.
 *
 * @package Haphan\Rage4DNS\Entity
 */
class Record implements TableRowInterface
{
    private $id;
    private $name;
    private $content;
    private $type;
    private $ttl;
    private $priority;
    private $domainID;
    private $geoRegionID;
    private $geoLat;
    private $geoLong;
    private $geoLock;
    private $failoverEnabled = false;
    private $failoverContent = null;
    private $failoverWithdraw = false;
    private $isActive = true;
    private $udpLimit = false;

    /**
     * Empty constructor.
     * Due to this entity holds many properties, it is best not to use a long constructor with 20+ parameters
     */
    public function __construct()
    {

    }

    /**
     * Set Geo Lock
     *
     * @param boolean $geoLock
     *
     * @return Record $this
     */
    public function setGeoLock($geoLock)
    {
        $this->geoLock = $geoLock;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGeoLock()
    {
        return $this->geoLock;
    }

    /**
     * @param boolean $failoverWithdraw
     *
     * @return Record
     */
    public function setFailoverWithdraw($failoverWithdraw)
    {
        $this->failoverWithdraw = $failoverWithdraw;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getFailoverWithdraw()
    {
        return $this->failoverWithdraw;
    }

    /**
     * Set Geo Lat
     *
     * @param long $geoLat
     *
     * @return Record $this
     */
    public function setGeoLat($geoLat)
    {
        $this->geoLat = $geoLat;

        return $this;
    }

    /**
     * Returns geo lat
     *
     * @return long
     */
    public function getGeoLat()
    {
        return $this->geoLat;
    }

    /**
     * Set Geo Long
     *
     * @param long $geoLong
     *
     * @return Record $this
     */
    public function setGeoLong($geoLong)
    {
        $this->geoLong = $geoLong;

        return $this;
    }

    /**
     * Returns geo long
     *
     * @return long
     */
    public function getGeoLong()
    {
        return $this->geoLong;
    }

    /**
     * Set Geo Region ID
     *
     * @param int $geoRegionID
     *
     * @return Record $this
     */
    public function setGeoRegionId($geoRegionID)
    {
        $this->geoRegionID = $geoRegionID;

        return $this;
    }

    /**
     * Returns Region ID
     *
     * @return int
     */
    public function getGeoRegionId()
    {
        return $this->geoRegionID;
    }

    /**
     * Set ID
     *
     * @param int $id
     *
     * @return Record $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Return ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Record
     */
    public function setActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Returns true if active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->isActive;
    }

    /**
     * Set UDP limit
     *
     * @param string $udpLimit
     *
     * @return Record $this
     */
    public function setUdpLimit($udpLimit)
    {
        $this->udpLimit = $udpLimit;

        return $this;
    }

    /**
     * Return UDP limit
     *
     * @return boolean
     */
    public function getUdpLimit()
    {
        return $this->udpLimit;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Record $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Returns record content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set Domain ID
     *
     * @param int $domainID
     *
     * @return Record
     */
    public function setDomainId($domainID)
    {
        $this->domainID = $domainID;

        return $this;
    }

    /**
     * Returns domain ID
     *
     * @return int
     */
    public function getDomainId()
    {
        return $this->domainID;
    }

    /**
     * Set Fail-over content
     *
     * @param string $failoverContent
     *
     * @return Record $this
     */
    public function setFailoverContent($failoverContent)
    {
        $this->failoverContent = $failoverContent;

        return $this;
    }

    /**
     * Returns fail-over content
     *
     * @return string|mixed
     */
    public function getFailoverContent()
    {
        return $this->failoverContent;
    }

    /**
     * Set true|false to fail-over
     *
     * @param boolean $failoverEnable
     *
     * @return Record $this
     */
    public function setFailoverEnabled($failoverEnable)
    {
        $this->failoverEnabled = $failoverEnable;

        return $this;
    }

    /**
     * Return true or false of fail-over is enabled.
     *
     * @return boolean
     */
    public function getFailoverEnabled()
    {
        return $this->failoverEnabled;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Record
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Returns name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set priority.
     *
     * @param int $priority
     *
     * @return Record
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Returns priority.
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set TTL
     *
     * @param int $ttl
     *
     * @return Record $this
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * Set record type. See records:types for values.
     *
     * @param int $type
     *
     * @return Record
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Returns type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Implements TableRowInterface
     *
     * @param bool $full
     *
     * @return array
     */
    public function getTableRow($full = false)
    {
        if (true === $full) {
            return array(
                $this->id,
                $this->name,
                $this->content,
                $this->type,
                $this->ttl,
                $this->priority,
                $this->domainID,
                $this->geoRegionID,
                $this->geoLat,
                $this->geoLong,
                $this->geoLock ? 'true' : 'false',
                $this->failoverEnabled ? 'true' : 'false',
                $this->failoverContent,
                $this->failoverWithdraw ? 'true' : 'false',
                $this->isActive ? 'true' : 'false',
                $this->udpLimit ? 'true' : 'false'

            );
        } else {
            return array(
                $this->id,
                $this->name,
                $this->content,
                $this->type,
                $this->ttl,
                $this->priority,
                $this->geoRegionID,
                $this->isActive ? 'true' : 'false'
            );
        }

    }

    /**
     * Implements TableRowInterface
     *
     * @param bool $full
     *
     * @return array
     */
    public static function getTableHeaders($full = false)
    {

        if (true === $full) {
            return array(
                'ID',
                'Name',
                'Content',
                'Type',
                'TTL',
                'Priority',
                'Domain',
                'Region',
                'Geo Lat',
                'Geo Long',
                'Geo Lock',
                'FO',
                'FO Content',
                'FO Withdraw',
                'Active',
                'UDP Limit'
            );
        } else {
            return array(
                'ID',
                'Name',
                'Content',
                'Type',
                'TTL',
                'Priority',
                'Region',
                'Active'
            );
        }

    }

    /**
     * Create Record instance from array.
     *
     * @param array $array
     *
     * @return Record
     */
    public static function createFromArray($array)
    {
        $r = new Record();

        $r->setId($array['id']);
        $r->setName($array['name']);
        $r->setContent($array['content']);
        $r->setTtl($array['ttl']);
        $r->setType($array['type']);
        $r->setPriority($array['priority']);
        $r->setDomainId($array['domain_id']);
        $r->setGeoRegionId($array['geo_region_id']);
        $r->setGeoLock($array['geo_lock']);
        $r->setGeoLong($array['geo_long']);
        $r->setGeoLat($array['geo_lat']);
        $r->setFailoverEnabled($array['failover_enabled']);
        $r->setFailoverContent($array['failover_content']);
        $r->setFailoverWithdraw($array['failover_withdraw']);
        $r->setActive($array['is_active']);
        $r->setUdpLimit($array['udp_limit']);

        return $r;

    }

    /**
     * Returns array data of Record entity.
     *
     * @return array
     */
    public function toArray()
    {
        $array = array(
            'name' => $this->name,
            'content' => $this->content,
            'type' => $this->type,
            'ttl' => $this->ttl,
            'priority' => $this->priority,
            'failover' => $this->failoverEnabled ? 'true' : 'false',
            'failovercontent' => $this->failoverContent,
            'ttl' => $this->ttl,
            'geozone' => $this->geoRegionID,
            'geolock' => $this->geoLock ? 'true' : 'false',
            'geolat' => $this->geoLat,
            'geolong' => $this->geoLong
        );

        return array_filter($array);
    }
}
