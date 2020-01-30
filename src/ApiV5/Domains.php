<?php
/**
 * @author      Yves Tannier
 * @copyright   2020 Yves Tannier
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5;

use GuzzleHttp\Exception\RequestException;

class Domains extends AbstractApi
{
    /**
     * @param array $params
     * @param string $orgId
     * @return string[]
     * @throws \Exception
     */
    function check($params, $orgId = '') {
        if ($orgId) {
            $response = $this->httpGet('domain/check', array_merge($params, [
                'sharing_id' => $orgId, 
            ]));
        } else {
            $response = $this->httpGet('domain/check', $params);
        }
        return json_decode($response->getBody());
    }

    /**
     * @return string[]
     * @throws \Exception
     */
    function tlds() {
        $response = $this->httpGet('domain/tlds');
        return json_decode($response->getBody());
    }

    /**
     * @param string $name
     * @return string[]
     * @throws \Exception
     */
    function tld($name) {
        $response = $this->httpGet('domain/tlds/'.$name);
        return json_decode($response->getBody());
    }

    /**
     * @param array $params
     * @param string $orgId
     * @return string[]
     * @throws \Exception
     */
    function get($params, $orgId = '') {
        if ($orgId) {
            $response = $this->httpGet('domain/domains', array_merge($params, [
                'sharing_id' => $orgId, 
            ]));
        } else {
            $response = $this->httpGet('domain/domains', $params);
        }
        return json_decode($response->getBody());
    }

    /**
     * @param string $domain
     * @return string[]
     * @throws \Exception
     */
    function contacts($domain) {
        $response = $this->httpGet('domain/domains/'.$domain.'/contacts');
        return json_decode($response->getBody());
    }

    /**
     * // NOT YET TESTED
     * @param string $domain
     * @return string[]
     * @throws \Exception
     */
    function updateContacts($domain, $params) { 
        $response = $this->httpPatch('domain/domains/'.$domain.'/contacts', $params);
        return json_decode($response->getBody());
    }

    /**
     * @param string $domain
     * @return string[]
     * @throws \Exception
     */
    function renewStatus($domain) {
        $response = $this->httpGet('domain/domains/'.$domain.'/renew');
        return json_decode($response->getBody());
    }

    /**
     * // NOT YET TESTED
     * @param string $domain
     * @param array $params
     * @param string $orgId
     * @return string[]
     * @throws \Exception
     */
    function renew($domain, $params, $orgId = '') { 
        $response = $this->httpPost('domain/domains/'.$domain.'/renew', $params);
        return json_decode($response->getBody());
    }

    /**
     * @param string $domain
     * @return string[]
     * @throws \Exception
     */
    function restoreStatus($domain) {
        $response = $this->httpGet('domain/domains/'.$domain.'/restore');
        return json_decode($response->getBody());
    }

    /**
     * // NOT YET TESTED
     * @param string $domain
     * @param array $params
     * @param string $orgId
     * @return string[]
     * @throws \Exception
     */
    function restore($domain, $orgId = '') { 
        $response = $this->httpPost('domain/domains/'.$domain.'/restore');
        return json_decode($response->getBody());
    }
}
