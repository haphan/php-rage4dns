<?php
/**
 * (c) Ha Phan <thanhha.work@gmail.com>
 * Date: 4/26/14
 * Time: 8:04 AM
 */

namespace Haphan\Rage4DNS\Entity;


class DomainUsageHistory implements TableRowInterface
{
    private $date;
    private $total;
    private $eu;
    private $us;
    private $sa;
    private $ap;
    private $af;

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

    public function getDate()
    {
        return $this->date;

    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setDate(\Datetime $date)
    {
        $this->date = $date;

        return $this;
    }

    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    public function getEU()
    {
        return $this->eu;
    }

    public function getUS()
    {
        return $this->us;
    }

    public function getSA()
    {
        return $this->sa;
    }

    public function getAP()
    {
        return $this->ap;
    }

    public function getAF()
    {
        return $this->af;
    }

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