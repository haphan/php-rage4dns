<?php

namespace Haphan\Rage4DNS\Entity;


class Status implements TableRowInterface
{
    private $status;
    private $id;
    private $error;

    public function __construct($status, $id, $error)
    {
        $this->status = $status;
        $this->id = $id;
        $this->error = $error;
    }

    public static function createFromArray($array)
    {
        return new Status($array['status'], $array['id'], $array['error']);
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
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

    public function getError()
    {
        return $this->error;
    }

    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * Implements TableRowInterface
     *
     * @return array
     */
    public static function getTableHeaders()
    {
        return array('Status', 'ID', 'Error');
    }

    /**
     * Implements TableRowInterface
     *
     * @return array
     */
    public function getTableRow()
    {
        return array($this->status ? 'true' : 'false', $this->id, $this->error);
    }
}