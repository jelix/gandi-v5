<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5;

use GuzzleHttp\Client;


class Status
{
    const STATUS_NONE = "none";
    const STATUS_MINOR = "minor";
    const STATUS_MAJOR = "major";
    const STATUS_CRITICAL = "critical";

    /**
     * @return array with "description" and "indicator" items
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @see https://status.gandi.net/api
     */
    function getCurrentStatus() {

        $client = new Client();
        $res = $client->get('https://xnm08yh10bv5.statuspage.io/api/v2/status.json');
        $gandi_status = json_decode($res->getBody(), true);
        return $gandi_status["status"];
    }
}
