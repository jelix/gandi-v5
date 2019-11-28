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

    /**
     * @param $apiPath
     * @param $method
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     * @throws GandiException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function _doHttp($apiPath, $method, $options = array())
    {
        $client = $this->getHttpClient();

        if (!isset($options['headers'])) {
            $options['headers'] = array();
        }
        $options['headers']['Authorization'] = 'Apikey '.$this->config->getApiKey();

        if (!isset($options['headers']['Accept'])) {
            $options['headers']['Accept'] = 'application/json';
        }

        $response = $client->request($method, $apiPath, $options);
        if ($response->getStatusCode() >= 400) {
            throw new GandiException($response);
        }

        return $response;
    }


    protected function httpGet($apiPath, $queryParameters = array(), $additionalHeaders = array())
    {
        $options = array(
            'headers' =>$additionalHeaders
        );

        if (count($queryParameters)) {
            $options['query'] = $queryParameters;
        }
        return $this->_doHttp($apiPath, 'GET', $options);
    }

    protected function httpPost($apiPath, $jsonData = array(), $additionalHeaders = array())
    {
        $options = array(
            'headers' =>$additionalHeaders,
            'json' => $jsonData
        );
        return $this->_doHttp($apiPath, 'POST', $options);
    }

    protected function httpPostForm($apiPath, $formParameters = array(), $additionalHeaders = array())
    {
        $options = array(
            'headers' => $additionalHeaders,
            'form_params' => $formParameters
        );

        return $this->_doHttp($apiPath, 'POST', $options);
    }

    protected function httpDelete($apiPath, $additionalHeaders = array())
    {
        $options = array(
            'headers' => array_merge($additionalHeaders),
        );

        return $this->_doHttp($apiPath, 'DELETE', $options);
    }

}
