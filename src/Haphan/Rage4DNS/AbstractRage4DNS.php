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

use Guzzle\Common\Exception\RuntimeException;
use Guzzle\Http\Client;
use Haphan\Rage4DNS\Entity\Status;

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
     * Constructor.
     *
     * @param Credentials $credentials The credentials to use.
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
     * @param  array      $headers
     * @param  array      $options
     * @return array|null
     * @throws \Exception
     */
    public function processQuery($url, $headers = array(), $options = array())
    {
        $request = $this->client->get(
            $url,
            $headers,
            $options
        );

        /**@var Response */
        $response = $this->client->send($request);

        if ($response->isSuccessful()) {

            try {
                return $response->json();
            } catch (RuntimeException $cannotParseJsonException) {
                return $response->getBody(true);
            }

        }else
            throw new \Exception("Fail to complete the request. Server returns code {$response->getStatusCode()}");

    }

    /**
     * Rage4 DNS does not properly return error code
     *
     * @param $response
     * @return null
     */
    protected function getStatusMessage($response)
    {
        if (is_array($response) && isset($response['status'])) {
            return Status::createFromArray($response['status']);
        } else return null;
    }

}
