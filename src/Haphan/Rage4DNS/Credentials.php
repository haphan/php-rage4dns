<?php

/**
 * This file is part of the haphan/php-rage4-dns-api Library.
 *
 * (c) Ha Phan <thanhha.work@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Haphan\Rage4DNS;

/**
 * Credentials class.
 *
 * @author Ha Phan <thanhha.work@gmail.com>
 */
class Credentials
{
    /**
     * The email.
     *
     * @var string
     */
    private $email;

    /**
     * The API key.
     *
     * @var string
     */
    private $accountKey;

    /**
     * @param $email User's email address
     * @param $accountKey Account Key is available in User Profile section of Rage4 DNS control panel.
     */
    public function __construct($email, $accountKey)
    {
        $this->email = $email;
        $this->accountKey   = $accountKey;
    }

    /**
     * Returns User's email address
     *
     * @return User|string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Returns Account key
     *
     * @return Account|string
     */
    public function getAccountKey()
    {
        return $this->accountKey;
    }
}
