<?php
/**
 * (c) Ha Phan <thanhha.work@gmail.com>
 * Date: 4/26/14
 * Time: 8:04 AM
 */

namespace Haphan\Rage4DNS\Entity;


class Record implements TableRowInterface
{
    private $id;
    private $name;
    private $content;
    private $type;
    private $ttl;
    private $priority;
    private $domain_id;
    private $geo_region_id;
    private $geo_lat;
    private $geo_long;
    private $geo_lock;

    /**
     * @param mixed $geo_lock
     */
    public function setGeoLock($geo_lock)
    {
        $this->geo_lock = $geo_lock;
    }

    /**
     * @return mixed
     */
    public function getGeoLock()
    {
        return $this->geo_lock;
    }
    private $failover_enabled = false;
    private $failover_content = null;
    private $failover_withdraw = false;
    private $is_active = true;
    private $udp_limit = false;

    public function __construct()
    {

    }

    /**
     * @param $failover_withdraw
     * @return Record
     */
    public function setFailoverWithdraw($failover_withdraw)
    {
        $this->failover_withdraw = $failover_withdraw;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getFailoverWithdraw()
    {
        return $this->failover_withdraw;
    }

    /**
     * @param $geo_lat
     * @return Record
     */
    public function setGeoLat($geo_lat)
    {
        $this->geo_lat = $geo_lat;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGeoLat()
    {
        return $this->geo_lat;
    }

    /**
     * @param $geo_long
     * @return Record
     */
    public function setGeoLong($geo_long)
    {
        $this->geo_long = $geo_long;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGeoLong()
    {
        return $this->geo_long;
    }

    /**
     * @param $geo_region_id
     * @return Record
     */
    public function setGeoRegionId($geo_region_id)
    {
        $this->geo_region_id = $geo_region_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGeoRegionId()
    {
        return $this->geo_region_id;
    }

    /**
     * @param $id
     * @return Record
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $is_active
     * @return Record
     */
    public function setIsActive($is_active)
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * @param $udp_limit
     * @return Record
     */
    public function setUdpLimit($udp_limit)
    {
        $this->udp_limit = $udp_limit;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getUdpLimit()
    {
        return $this->udp_limit;
    }

    /**
     * @param $content
     * @return Record
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param $domain_id
     * @return Record
     */
    public function setDomainId($domain_id)
    {
        $this->domain_id = $domain_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDomainId()
    {
        return $this->domain_id;
    }

    /**
     * @param $failover_content
     * @return Record
     */
    public function setFailoverContent($failover_content)
    {
        $this->failover_content = $failover_content;

        return $this;
    }

    /**
     * @return null
     */
    public function getFailoverContent()
    {
        return $this->failover_content;
    }

    /**
     * @param $failover_enabled
     * @return Record
     */
    public function setFailoverEnabled($failover_enabled)
    {
        $this->failover_enabled = $failover_enabled;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getFailoverEnabled()
    {
        return $this->failover_enabled;
    }

    /**
     * @param $name
     * @return Record
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $priority
     * @return Record
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return null
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param $ttl
     * @return Record
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
     * @param $type
     * @return Record
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Implements TableRowInterface
     *
     * @return array
     */
    public function getTableRow($full = false)
    {
        if(true === $full)
        {
            return array(
                $this->id,
                $this->name,
                $this->content,
                $this->type,
                $this->ttl,
                $this->priority,
                $this->domain_id,
                $this->geo_region_id,
                $this->geo_lat,
                $this->geo_long,
                $this->geo_lock ? 'true' : 'false',
                $this->failover_enabled ? 'true' : 'false',
                $this->failover_content,
                $this->failover_withdraw ? 'true' : 'false',
                $this->is_active ? 'true' : 'false',
                $this->udp_limit ? 'true' : 'false'

            );
        }else
        {
            return array(
                $this->id,
                $this->name,
                $this->content,
                $this->type,
                $this->ttl,
                $this->priority,
                $this->geo_region_id,
                $this->is_active ? 'true' : 'false'
            );
        }

    }

    /**
     * Implements TableRowInterface
     *
     * @return array
     */
    public static function getTableHeaders($full = false)
    {

        if(true === $full)
        {
            return array(
                'ID','Name','Content','Type', 'TTL',
                'Priority','Domain','Region', 'Geo Lat', 'Geo Long',
                'Geo Lock','FO','FO Content','FO Withdraw', 'Active',
                'UDP Limit'
            );
        }else{
            return array(
                'ID','Name','Content','Type', 'TTL',
                'Priority', 'Region', 'Active'
            );
        }

    }

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
        $r->setIsActive($array['is_active']);
        $r->setUdpLimit($array['udp_limit']);

        return $r;

    }

    public function toArray()
    {
        $array = array(
            'name' => $this->name,
            'content' => $this->content,
            'type' => $this->type,
            'ttl' => $this->ttl,
            'priority' => $this->priority,
            'failover' => $this->failover_enabled ? 'true' : 'false',
            'failovercontent' => $this->failover_content,
            'ttl' => $this->ttl,
            'geozone' => $this->geo_region_id,
            'geolock' => $this->geo_lock ? 'true' : 'false',
            'geolat' => $this->geo_lat,
            'geolong' => $this->geo_long
        );

        return array_filter($array);
    }
}