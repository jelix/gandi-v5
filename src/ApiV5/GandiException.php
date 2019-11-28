<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5;

use GuzzleHttp\Psr7\Response;
use Throwable;

class GandiException extends \Exception
{

    protected $json;

    function __construct(Response $response)
    {
        $this->json = json_decode($response->getBody());
        parent::__construct($this->json['cause'].": ".$this->json['message'], $this->json['code']);
    }

    function getErrorCause() {
        return $this->json['cause'];
    }

    function getErrorMessage() {
        return $this->json['message'];
    }

    function getErrorObject() {
        return $this->json['object'];
    }
}
