<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5;
use Jelix\GandiApi\ApiV5\Entities\Organization;

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


    /**
     * @param $name
     * @return Organization|null  null if not found
     * @throws \Exception
     */
    function getOrganizationByName($name) {
        $response = $this->httpGet("organization/organizations", array('name'=>$name));
        $organizations = json_decode($response->getBody());
        if (count($organizations)) {
            return Organization::createFromApi($organizations[0]);
        }
        return null;
    }
}
