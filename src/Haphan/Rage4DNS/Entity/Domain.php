<?php

namespace Haphan\Rage4DNS\Entity;

class Domain implements TableRowInterface
{
    private $id;
    private $name;
    private $ownerEmail;
    private $type;
    private $subnetMask;

    public function __construct($id, $name, $ownerEmail, $type, $subnetMask)
    {
        $this->id = $id;
        $this->name = $name;
        $this->ownerEmail = $ownerEmail;
        $this->type = $type;
        $this->subnetMask = $subnetMask;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getOwnerEmail()
    {
        return $this->ownerEmail;
    }

    public function setOwnerEmail($ownerEmail)
    {
        $this->ownerEmail = $ownerEmail;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getSubnetMask()
    {
        return $this->subnetMask;
    }

    public function setSubnetMask($subnetMask)
    {
        $this->subnetMask = $subnetMask;

        return $this;
    }

    /**
     * Factory method to create Domain instance from array.
     *
     *
     * @param $array
     * @return Domain
     */
    public static function createFromArray($array)
    {
        return new Domain(
            $array['id'],
            $array['name'],
            $array['owner_email'],
            $array['type'],
            $array['subnet_mask']
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
            $this->id,
            $this->name,
            $this->ownerEmail,
            $this->type,
            $this->subnetMask
        );
    }

    /**
     * Implements TableRowInterface
     *
     * @return array
     */
    public static function getTableHeaders()
    {
        return array('ID', 'Name', 'Owner Email', 'Type', 'Subnet Mask');
    }

}
