<?php
/**
 * (c) Ha Phan <thanhha.work@gmail.com>
 * Date: 4/26/14
 * Time: 8:04 AM
 */

namespace Haphan\Rage4DNS\Entity;


class GlobalUsageHistory implements TableRowInterface
{
    private $date;
    private $value;

    public function __construct(\DateTime $date, $count)
    {
        $this->date = $date;
        $this->value = $count;
    }

    public function getDate()
    {
        return $this->date;

    }

    public function getValue()
    {
        return $this->value;
    }

    public function setDate(\Datetime $date)
    {
        $this->date = $date;

        return $this;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
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
            $this->value
        );
    }

    /**
     * Implements TableRowInterface
     *
     * @return array
     */
    public static function getTableHeaders()
    {
        return array('Date', 'Value');
    }

    public static function createFromArray($array)
    {
        return new GlobalUsageHistory(
            new \DateTime($array['date']),
            $array['value']
        );
    }
}