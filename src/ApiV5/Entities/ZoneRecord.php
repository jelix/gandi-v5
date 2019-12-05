<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5\Entities;


class ZoneRecord
{

    protected $name = '';

    protected $type = '';

    protected $ttl = 10800;

    protected $values = array();

    /**
     * ZoneRecord constructor
     */
    function __construct($name, $type, $values, $ttl=10800)
    {
        $this->name = $name;
        $this->type = $type;
        $this->ttl = $ttl;
        $this->values = $values;
    }

    /**
     * Create a ZoneRecord object from data retrieved with the web API
     * @param \stdClass $rawRecord
     */
    static function createFromApi($rawRecord)
    {
        return new ZoneRecord(
            $rawRecord->rrset_name,
            $rawRecord->rrset_type,
            $rawRecord->rrset_ttl,
            $rawRecord->rrset_values
        );
    }

    public function getName() {
        return $this->name;
    }

    public function getType() {
        return $this->type;
    }

    public function getTtl() {
        return $this->ttl;
    }

    public function getValues() {
        return $this->values;
    }

    public function toJsonData() {
        return array(
            'rrset_name' => $this->name,
            'rrset_type' => $this->type,
            'rrset_values' => $this->values,
            'rrset_ttl' => $this->ttl,
        );
    }
}
