<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5;


use Jelix\GandiApi\ApiV5\LiveDns\ZoneRecord;

class LiveDns extends AbstractApi
{

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

}
