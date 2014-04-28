<?php
/**
 * (c) Ha Phan <thanhha.work@gmail.com>
 * Date: 4/26/14
 * Time: 8:04 AM
 */

namespace Haphan\Rage4DNS\Entity;

/**
 * Class RecordType
 *
 * @package Haphan\Rage4DNS\Entity
 */
class RecordType implements TableRowInterface
{
    private $name;

    private $typeValue;

    /**
     * Constructor
     *
     * @param string    $name
     * @param int       $typeValue
     */
    public function __construct($name, $typeValue)
    {
        $this->name = $name;

        $this->typeValue = $typeValue;
    }

    /**
     * Set value
     *
     * @param int   $value
     *
     * @return RecordType $this
     */
    public function setTypeValue($value)
    {
        $this->typeValue = $value;

        return $this;
    }

    /**
     * Returns type value
     *
     * @return int
     */
    public function getTypeValue()
    {
        return $this->typeValue;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return RecordType $this
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
     * Implements TableRowInterface
     *
     * @return array
     */
    public function getTableRow()
    {
        return array(
            $this->name,
            $this->typeValue
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

    /**
     * Construct region instance from array.
     * Internally use to to construct region from API response.
     *
     * @param array $array
     *
     * @return RecordType
     */
    public static function createFromArray($array)
    {
        return new RecordType(
            $array['name'],
            $array['value']
        );
    }
}