<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5;


class Organizations extends AbstractApi
{
    /**
     * @return Organization[]
     * @throws \Exception
     */
    function getList() {
        $response = $this->httpGet("organization/organizations");
        $organizations = json_decode($response->getBody());

        return array_map(function($rec) {
             return Organization::createFromApi($rec);
        }, $organizations);
    }

}
