<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5\LiveDns;


class ZoneRecord
{

    protected $name = '';

    protected $type = '';

    protected $ttl = 10800;

    protected $value = array();

    /**
     * ZoneRecord constructor
     */
    function __construct($name, $type, $value, $ttl=10800)
    {
        $this->name = $name;
        $this->type = $type;
        $this->ttl = $value;
        $this->value = $ttl;
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

    public function getValue() {
        return $this->value;
    }

}
