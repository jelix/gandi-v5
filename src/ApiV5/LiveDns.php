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

    /**
     * Create a record.
     *
     * If the record already exists with same values, no error, else a
     * GandiException occurs.
     *
     * @param string $domain
     * @param  ZoneRecord  $record
     *
     * @return string  an informal message from Gandi
     * @throws GandiException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function createRecord($domain, ZoneRecord $record)
    {
        $response = $this->httpPost("livedns/domains/$domain/records", $record->toJsonData());
        $record = json_decode($response->getBody());
        return $record->message;
    }

    /**
     * Create a record, or update it if it already exists
     *
     * If it fails, an exception occurs.
     *
     * @param string $domain
     * @param  ZoneRecord  $record the record to create or update
     *
     * @return  string  an informal message from Gandi
     * @throws GandiException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function createOrUpdateRecord($domain, ZoneRecord $record)
    {
        try {
            $url = "livedns/domains/$domain/records/".$record->getName()."/".$record->getType();
            $this->httpGet($url);
            // ok, we got a valid response, let's update the record
            $response = $this->httpPut($url, $record->toJsonData());
            $message = json_decode($response->getBody());
        }
        catch(GandiException $e) {
            if ($e->getCode() == '404') {
                return $this->createRecord($domain, $record);
            }
            throw $e;
        }
        catch(RequestException $e) {
            if ($e->getResponse()->getStatusCode() == '404') {
                return $this->createRecord($domain, $record);
            }
            throw $e;
        }
        return $message->message ;
    }

    /**
     * Create a record only if it does not already exist
     *
     * If it fails, an exception occurs.
     *
     * @param string $domain
     * @param  ZoneRecord  $record the record to create
     *
     * @return  string  an informal message from Gandi if the record does not exists
     * @throws GandiException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
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

    /**
     * Update a record
     *
     * If it fails, an exception occurs.
     *
     * @param string $domain
     * @param  ZoneRecord  $record
     *
     * @return string  an informal message from Gandi
     * @throws GandiException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function updateRecord($domain, ZoneRecord $record)
    {
        $url = "livedns/domains/$domain/records/".$record->getName()."/".$record->getType();
        $this->httpGet($url);
        // ok, we got a valid response, let's update the record
        $response = $this->httpPut($url, $record->toJsonData());
        $message = json_decode($response->getBody());
        return $message->message ;
    }

    /**
     * @param string $domain the root domain
     * @param string $name the subdomain name
     * @param string $type A, CNAME etc..
     *
     * @return ZoneRecord|null the record or null if it does not exists
     * @throws GandiException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function getRecord($domain, $name, $type)
    {
        try {
            $url = "livedns/domains/$domain/records/".$name."/".$type;
            $response = $this->httpGet($url);
            $message = json_decode($response->getBody());
            $record = new ZoneRecord($message->rrset_name, $message->rrset_type,
                                     $message->rrset_values,
                (isset($message->rrset_ttl)?$message->rrset_ttl:0));
            return $record;
        }
        catch(GandiException $e) {
            if ($e->getCode() == '404') {
                return null;
            }
            throw $e;
        }
        catch(RequestException $e) {
            if ($e->getResponse()->getStatusCode() == '404') {
                return null;
            }
            throw $e;
        }
    }

    /**
     * Delete a record
     * @param string $domain
     * @param  ZoneRecord  $record
     *
     * @throws GandiException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function deleteRecord($domain, ZoneRecord $record)
    {
        $url = "livedns/domains/$domain/records/".$record->getName()."/".$record->getType();
        $this->httpDelete($url);
    }

}
