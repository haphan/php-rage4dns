<?php
/**
 * (c) Ha Phan <thanhha.work@gmail.com>
 * Date: 4/26/14
 * Time: 8:04 AM
 */

namespace Haphan\Rage4DNS\Entity;

/**
 * Class GlobalUsageHistory
 *
 * @package Haphan\Rage4DNS\Entity
 */
class GlobalUsageHistory implements TableRowInterface
{
    private $date;
    private $value;

    /**
     * Constructor
     *
     * @param \DateTime $date
     * @param long      $count
     */
    public function __construct(\DateTime $date, $count)
    {
        $this->date = $date;
        $this->value = $count;
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
     * Return value
     *
     * @return long
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set Date
     *
     * @param \Datetime $date
     *
     * @return GlobalUsageHistory $this
     */
    public function setDate(\Datetime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Set Value
     *
     * @param long $value
     *
     * @return GlobalUsageHistory $this
     */
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

    /**
     * Constructor using array. Use internally
     *
     * @param array $array
     *
     * @return GlobalUsageHistory
     */
    public static function createFromArray($array)
    {
        return new GlobalUsageHistory(
            new \DateTime($array['date']),
            $array['value']
        );
    }
}
