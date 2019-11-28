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

    function getCurrentStatus() {

        $client = new Client();
        $res = $client->get('https://status.gandi.net/api/status');
        $gandi_status = json_decode($res->getBody(), true);
        return $gandi_status["status"];
    }

}
