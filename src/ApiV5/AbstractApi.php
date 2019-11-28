<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5;


use GuzzleHttp\Client;
use Jelix\GandiApi\Configuration;

abstract class AbstractApi
{

    /**
     * @var Configuration
     */
    protected $config;

    function __construct(Configuration $config) {
        $this->config = $config;
    }

    /**
     * @var Client
     */
    private $_client = null;

    /**
     * @return Client
     */
    protected function getHttpClient() {

        if (!$this->_client) {
            $this->_client = new Client(
                [
                    'base_uri' => 'https://'.$this->config->getGandiEndPoint().'/v5/'
                ]
            );
        }
        return $this->_client;
    }

    protected function httpGet($apiPath, $queryParameters = array(), $additionalHeaders = array())
    {
        $client = $this->getHttpClient();

        $headers = array(
            'Authorization'=>'Apikey '.$this->config->getApiKey(),
            'Accept' => 'application/json'
        );

        $options = array(
            'headers' => array_merge($headers, $additionalHeaders)
        );

        if (count($queryParameters)) {
            $options['query'] = $queryParameters;
        }
        $response = $client->request('GET', $apiPath, $options);
        if ($response->getStatusCode() >= 300) {
            throw new \Exception("Http error: ".$response->getReasonPhrase());
        }

        return $response;
    }


}
