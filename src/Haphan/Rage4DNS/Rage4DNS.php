<?php

namespace Haphan\Rage4DNS;


class Rage4DNS extends AbstractRage4DNS
{
    const VERSION = '1.0';

    /**@var API\Domains*/
    public $domains;

    public $records;

    protected $credentials;

    public function __construct(Credentials $credentials)
    {
        parent::__construct($credentials);

        $this->domains = new API\Domains($credentials);

    }
}