<?php

namespace Haphan\Rage4DNS;

/**
 * Class Rage4DNS
 *
 * @package Haphan\Rage4DNS
 */
class Rage4DNS extends AbstractRage4DNS
{
    const VERSION = '1.0';

    /**@var API\Domains*/
    public $domains;

    /**@var API\Usage */
    public $usage;

    /**@var API\Records*/
    public $records;

    protected $credentials;

    /**
     * Constructor
     *
     * @param Credentials $credentials
     */
    public function __construct(Credentials $credentials)
    {
        parent::__construct($credentials);

        $this->domains = new API\Domains($credentials);
        $this->usage = new API\Usage($credentials);
        $this->records = new API\Records($credentials);

    }
}