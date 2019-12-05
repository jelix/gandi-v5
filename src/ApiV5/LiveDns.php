<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5;


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

    function createRecord($domain, ZoneRecord $record)
    {
        $response = $this->httpPost("livedns/domains/$domain/records", $record->toJsonData());
        $record = json_decode($response->getBody());
        return $record->message;
    }

}
