<?php
/**
 * (c) Ha Phan <thanhha.work@gmail.com>
 * Date: 4/26/14
 * Time: 8:04 AM
 */

namespace Haphan\Rage4DNS\Entity;

/**
 * Class DomainUsageHistory
 *
 * @package Haphan\Rage4DNS\Entity
 */
class DomainUsageHistory implements TableRowInterface
{
    private $date;
    private $total;
    private $eu;
    private $us;
    private $sa;
    private $ap;
    private $af;

    /**
     * @param \DateTime $date
     * @param int       $total
     * @param int       $eu
     * @param int       $us
     * @param int       $sa
     * @param int       $ap
     * @param int       $af
     */
    public function __construct(\DateTime $date, $total = 0, $eu = 0 , $us = 0, $sa = 0, $ap = 0, $af = 0)
    {
        $this->date = $date;
        $this->total = $total;
        $this->eu = $eu;
        $this->us = $us;
        $this->sa = $sa;
        $this->ap = $ap;
        $this->af = $af;
    }

    /**
     * Returns date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;

    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param \Datetime $date
     *
     * @return $this
     */
    public function setDate(\Datetime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @param int $total
     *
     * @return $this
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return int
     */
    public function getEU()
    {
        return $this->eu;
    }

    /**
     * @return int
     */
    public function getUS()
    {
        return $this->us;
    }

    /**
     * @return int
     */
    public function getSA()
    {
        return $this->sa;
    }

    /**
     * @return int
     */
    public function getAP()
    {
        return $this->ap;
    }

    /**
     * @return int
     */
    public function getAF()
    {
        return $this->af;
    }

    /**
     * @param array $array
     *
     * @return DomainUsageHistory
     */
    public static function createFromArray($array)
    {
        return new DomainUsageHistory(
            new \DateTime($array['date']),
            $array['total'],
            $array['eu'],
            $array['us'],
            $array['sa'],
            $array['ap'],
            $array['af']
        );
    }

    /**
     * Implements TableRowInterface
     *
     * @return array
     */
    public function getTableRow()
    {
        return array(
            $this->date->format("Y-m-d"),
            $this->total
        );
    }

    /**
     * Implements TableRowInterface
     *
     * @return array
     */
    public static function getTableHeaders()
    {
        return array('Date', 'Total');
    }
}
