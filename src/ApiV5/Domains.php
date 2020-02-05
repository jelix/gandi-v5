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
    function search($params, $orgId = '') {
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
     * @param array $params
     * @param string $orgId
     * @return string[]
     * @throws \Exception
     */
    function get($params, $orgId = '') {
        if ($orgId) {
            $response = $this->httpGet('domain/domains/'.$params['name'], array_merge($params, [
                'sharing_id' => $orgId, 
            ]));
        } else {
            $response = $this->httpGet('domain/domains/'.$params['name'], $params);
        }
        return json_decode($response->getBody());
    }

    /**
    // TODO
     * @param array $params
     * @param string $orgId
     * @return string[]
     * @throws \Exception
     */
    function create($params, $orgId = '') {
        if ($orgId) {
            $response = $this->httpPost('domain/domains/'.$params['name'], array_merge($params, [
                'sharing_id' => $orgId, 
            ]));
        } else {
            $response = $this->httpPost('domain/domains/'.$params['name'], $params);
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
    function renew($domain, $params, $orgId = '', $dryRun = 0) { 
        if ($orgId) { // organization
            $params['sharing_id'] = $orgId;
        }
        $response = $this->httpPost('domain/domains/'.$domain.'/renew', $params, ['Dry-Run' => $dryRun]);
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

    /**
     * @param string $domain
     * @return string[]
     * @throws \Exception
     */
    function nameservers($domain) {
        $response = $this->httpGet('domain/domains/'.$domain.'/nameservers');
        return json_decode($response->getBody());
    }

    /**
     * @param string $domain
     * @param array $nameservers
     * @return string[]
     * @throws \Exception
     */
    function updateNameservers($domain, $nameservers) { 
        $response = $this->httpPut('domain/domains/'.$domain.'/nameservers', [
            'nameservers' => $nameservers
        ]);
        return json_decode($response->getBody());
    }

    /**
     * @param string $domain
     * @return string[]
     * @throws \Exception
     */
    function gluerecords($domain) {
        $response = $this->httpGet('domain/domains/'.$domain.'/hosts');
        return json_decode($response->getBody());
    }

    /**
     * // NOT YET TESTED
     * @param string $domain
     * @return string[]
     * @throws \Exception
     */
    function gluerecordsCreate($domain, $params) { 
        $response = $this->httpPost('domain/domains/'.$domain.'/hosts', $params);
        return json_decode($response->getBody());
    }

    /**
     * @param string $domain
     * @return string[]
     * @throws \Exception
     */
    function gluerecord($domain, $name) {
        $response = $this->httpGet('domain/domains/'.$domain.'/hosts/'.$name);
        return json_decode($response->getBody());
    }

    /**
     * // NOT YET TESTED
     * @param string $domain
     * @return string[]
     * @throws \Exception
     */
    function gluerecordUpdate($domain, $name, $params) { 
        $response = $this->httpPost('domain/domains/'.$domain.'/hosts/'.$name, $params);
        return json_decode($response->getBody());
    }

    /**
     * // NOT YET TESTED
     * @param string $domain
     * @return string[]
     * @throws \Exception
     */
    function gluerecordRemove($domain, $name) { 
        $response = $this->httpDelete('domain/domains/'.$domain.'/hosts/'.$name);
        return json_decode($response->getBody());
    }
}
