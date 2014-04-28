<?php
/**
 * (c) Ha Phan <thanhha.work@gmail.com>
 * Date: 4/26/14
 * Time: 8:04 AM
 */

namespace Haphan\Rage4DNS\Entity;


class Region implements TableRowInterface
{
    private $name;
    private $value;

    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $name
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
     * Implements TableRowInterface
     *
     * @return array
     */
    public function getTableRow()
    {
        return array(
            $this->name,
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
        return array('Name', 'Value');
    }

    public static function createFromArray($array)
    {
        return new RecordType(
            $array['name'],
            $array['value']
        );
    }
}