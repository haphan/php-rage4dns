<?php

/**
 * This file is part of the haphan/php-rage4-dns-api Library.
 *
 * (c) Ha Phan <http://github.com/haphan>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Haphan\Rage4DNS\API;

use Haphan\Rage4DNS\AbstractRage4DNS;
use Haphan\Rage4DNS\Credentials;
use Haphan\Rage4DNS\Entity\Domain;
use Haphan\Rage4DNS\Entity\Status;

/**
 * Class Domains
 *
 * @package Haphan\Rage4DNS\API
 */
class Domains extends AbstractRage4DNS
{
    const URL_ALL_DOMAINS = 'getdomains';
    const URL_GET_DOMAIN = 'getdomain';
    const URL_GET_DOMAIN_BY_NAME = 'getdomainbyname';
    const URL_CREATE_REGULAR_DOMAIN = 'createregulardomain';
    const URL_CREATE_VANITY_DOMAIN = 'createregulardomainext';
    const URL_CREATE_REVERSE_IPV4 = 'createreversedomain4';
    const URL_CREATE_REVERSE_IPV6 = 'createreversedomain6';
    const URL_UPDATE_DOMAIN = 'updatedomain';
    const URL_DELETE_DOMAIN = 'deletedomain';
    const URL_EXPORT_ZONE = 'exportzonefile';

    /**
     * @param Credentials $credentials
     */
    public function __construct(Credentials $credentials)
    {
        parent::__construct($credentials);
    }

    /**
     * Get all active domains
     *
     * @return Domain[]
     */
    public function getAll()
    {
        $url = sprintf("%s/%s", $this->apiUrl, self::URL_ALL_DOMAINS);

        $domainsArray =  $this->processQuery($url);

        $domains = array();

        foreach ($domainsArray as $d) {
            $domains[]  = Domain::createFromArray($d);
        }

        return $domains;
    }

    /**
     * Get a single domain by ID
     *
     * @param int $id
     *
     * @return Domain
     */
    public function getById($id)
    {
        $url = sprintf("%s/%s/%d", $this->apiUrl, self::URL_GET_DOMAIN, $id);

        $json =  $this->processQuery($url);

        return Domain::createFromArray($json);
    }

    /**
     * Get a single domain by name
     *
     * @param string $name
     *
     * @return Domain
     */
    public function getByName($name)
    {
        $url = sprintf("%s/%s/", $this->apiUrl, self::URL_GET_DOMAIN_BY_NAME);

        $json =  $this->processQuery($url, null, array(
            'query' => array('name' => $name)
        ));

        return Domain::createFromArray($json);
    }

    /**
     * Create a regular domain
     *
     * @param string $domainName
     * @param string $email
     *
     * @return Status
     */
    public function createDomain($domainName, $email)
    {
        $url = sprintf("%s/%s/", $this->apiUrl, self::URL_CREATE_REGULAR_DOMAIN);

        $response =  $this->processQuery($url, null, array(
            'query' => array(
                'name' => $domainName,
                'email' => $email
            )
        ));

        return Status::createFromArray($response);
    }

    /**
     * Create regular domain with vanity name server
     *
     * @param string $domainName Name of domain
     * @param string $email      Email of owner
     * @param string $nsname     Domain name of vanity name server
     * @param string $prefix     Default to ns
     *
     * @return Status
     */
    public function createDomainVanity($domainName, $email, $nsname, $prefix = 'ns')
    {
        $url = sprintf("%s/%s/", $this->apiUrl, self::URL_CREATE_VANITY_DOMAIN);

        $response =  $this->processQuery($url, null, array(
            'query' => array(
                'name' => $domainName,
                'email' => $email,
                'nsname' => $nsname,
                'nsprefix' => $prefix
            )
        ));

        return Status::createFromArray($response);

    }

    /**
     * Create reverse IPv4 domain
     *
     * @param string $domainName
     * @param string $email
     * @param string $subnetMask
     *
     * @return Status
     */
    public function createReverseIPv4($domainName, $email, $subnetMask)
    {
        $url = sprintf("%s/%s/", $this->apiUrl, self::URL_CREATE_REVERSE_IPV4);

        $response =  $this->processQuery($url, null, array(
            'query' => array(
                'name' => $domainName,
                'email' => $email,
                'subnet' => $subnetMask
            )
        ));

        return Status::createFromArray($response);
    }

    /**
     * Create reverse IPv6 domain
     *
     * @param string $domainName
     * @param string $email
     * @param string $subnetMask
     *
     * @return Status
     */
    public function createReverseIPV6($domainName, $email, $subnetMask)
    {
        $url = sprintf("%s/%s/", $this->apiUrl, self::URL_CREATE_REVERSE_IPV6);

        $response =  $this->processQuery($url, null, array(
            'query' => array(
                'name' => $domainName,
                'email' => $email,
                'subnet' => $subnetMask
            )
        ));

        return Status::createFromArray($response);
    }

    /**
     * Update domain
     *
     * To activate Vanity NS set values of nsname, nsprefix and set $enableVanity to true.
     * To deactivate Vanity NS set empty values to nsname, nsprefix and set $enableVanity to false.
     *
     * @param int     $id
     * @param string  $email
     * @param string  $nsname
     * @param string  $nsprefix
     * @param boolean $enableVanity
     *
     * @return Status
     */
    public function updateDomain($id, $email, $nsname, $nsprefix, $enableVanity)
    {
        $url = sprintf("%s/%s/", $this->apiUrl, self::URL_UPDATE_DOMAIN);

        $response =  $this->processQuery($url, null, array(
            'query' => array(
                'id' => $id,
                'email' => $email,
                'nsname' => $nsname,
                'nsprefix' => $nsprefix,
                'enablevanity' => $enableVanity
            )
        ));

        return Status::createFromArray($response);
    }

    /**
     * Delete a domain
     *
     * @param int $id
     *
     * @return Status
     */
    public function deleteDomain($id)
    {
        $url = sprintf("%s/%s/", $this->apiUrl, self::URL_DELETE_DOMAIN);

        $response =  $this->processQuery($url, null, array(
            'query' => array(
                'id' => $id
            )
        ));

        return Status::createFromArray($response);
    }

    /**
     * Export's zone as BIND compatible file format
     *
     * @param int $id
     *
     * @return string|null
     */
    public function exportZone($id)
    {
        $url = sprintf("%s/%s/%d/", $this->apiUrl, self::URL_EXPORT_ZONE, $id);

        return $this->processQuery($url);
    }

}
