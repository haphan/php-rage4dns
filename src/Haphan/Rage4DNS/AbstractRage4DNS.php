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

use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;

abstract class AbstractRage4DNS
{


    /**
     * The url of the API endpoint.
     *
     * @var array
     */
    const ENDPOINT_URL = 'https://secure.rage4.com/rapi';


    const USER_AGENT = 'Haphan/Rage4DNS CLI Client 1.0 (+http://github.com/haphan)';

    /**
     * The credentials.
     *
     * @var array
     */
    protected $credentials;

    /**
     * The API url.
     *
     * @var string
     */
    protected $apiUrl;

    /**
     * Guzzule Http client instance
     *
     * @var \Guzzle\Http\Client
     */
    protected $client;

    /**
     * Default Http client options
     *
     * @var array
     */
    private $options;

    /**
     * Constructor.
     *
     * @param Credentials   $credentials The credentials to use.
     */
    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
        $this->apiUrl  = self::ENDPOINT_URL;

        //Initialize API Client
        $this->client = new Client(self::ENDPOINT_URL);

        $this->client->setDefaultOption('auth', array(
                $this->credentials->getEmail(),
                $this->credentials->getAccountKey(),
                'Basic'
            ));

        $this->client->setUserAgent(self::USER_AGENT);
    }

    /**
     * Process API Call
     *
     * @param array $headers
     * @param array $options
     * @return array|Response|null
     */
    public function processQuery($headers = array(), $options = array())
    {
        $request = $this->client->get(
            $this->apiUrl,
            $headers,
            $options
        );

        /**@var Response */
        $response = $this->client->send($request);

        return $response;
    }

}