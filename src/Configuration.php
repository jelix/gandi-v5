<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi;

/**
 * Hold configuration parameters to call Gandi API
 */
class Configuration {

    protected $apiKey = '';

    function __construct($apiKey)
    {
        $this->apiKey = preg_replace("/\s/m", "", $apiKey);
    }


    function getApiKey()
    {
        return $this->apiKey;
    }
}
