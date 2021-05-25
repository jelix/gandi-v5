<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5;


use GuzzleHttp\Exception\RequestException;
use Jelix\GandiApi\ApiV5\Entities\ZoneRecord;

class LiveDns extends AbstractApi
{
    /**
     * @param string $orgId
     * @return string[]
     * @throws \Exception
     */
    function getDomainsList($orgId = '') {
        if ($orgId) {
            $response = $this->httpGet("livedns/domains", array('sharing_id'=>$orgId));
        }
        else {
            $response = $this->httpGet("livedns/domains");
        }
        $domains = json_decode($response->getBody());
        return array_map(function($rec) {
            return $rec->fqdn;
        }, $domains);
    }

    /**
     * @param string $domain
     * @return ZoneRecord[]
     * @throws \Exception
     */
    function getRecordsList($domain) {
        $response = $this->httpGet("livedns/domains/$domain/records");
        $records = json_decode($response->getBody());
        return array_map(function($rec) {
            return ZoneRecord::createFromApi($rec);
        }, $records);
    }

    function createRecordIfNotExists($domain, ZoneRecord $record)
    {
        try {
            $this->httpGet("livedns/domains/$domain/records/".$record->getName()."/".$record->getType());
        }
        catch(RequestException $e) {
            if ($e->getResponse()->getStatusCode() == '404') {
                return $this->createRecord($domain, $record);
            }
            throw $e;
        }
        return '';
    }

    function createRecord($domain, ZoneRecord $record)
    {
        $response = $this->httpPost("livedns/domains/$domain/records", $record->toJsonData());
        $record = json_decode($response->getBody());
        return $record->message;
    }

    function createOrUpdateRecord($domain, ZoneRecord $record)
    {
        try {
            $url = "livedns/domains/$domain/records/".$record->getName()."/".$record->getType();
            $this->httpGet($url);
            // ok, we got a valid response, let's update the record
            $response = $this->httpPut($url, $record->toJsonData());
            $message = json_decode($response->getBody());
        }
        catch(RequestException $e) {
            if ($e->getResponse()->getStatusCode() == '404') {
                return $this->createRecord($domain, $record);
            }
            throw $e;
        }
        return $message->message ;
    }

    function updateRecord($domain, ZoneRecord $record)
    {
        $url = "livedns/domains/$domain/records/".$record->getName()."/".$record->getType();
        $this->httpGet($url);
        // ok, we got a valid response, let's update the record
        $response = $this->httpPut($url, $record->toJsonData());
        $message = json_decode($response->getBody());
        return $message->message ;
    }

    function deleteRecord($domain, ZoneRecord $record)
    {
        $url = "livedns/domains/$domain/records/".$record->getName()."/".$record->getType();
        $this->httpDelete($url);
    }

}
