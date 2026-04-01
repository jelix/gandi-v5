<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019-2026 Laurent Jouanneau
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
    function __construct($name, $type, array $values, $ttl=10800)
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
    static function createFromApi($rawRecord) : ZoneRecord
    {
        return new ZoneRecord(
            $rawRecord->rrset_name,
            $rawRecord->rrset_type,
            $rawRecord->rrset_values,
            isset($rawRecord->rrset_ttl)? $rawRecord->rrset_ttl: 0
        );
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function getTtl() : int
    {
        return $this->ttl;
    }

    public function getValues() : array
    {
        return $this->values;
    }

    public function equalsTo($record) : bool
    {
        return $record->getName() == $this->name
            && $record->getType() == $this->type
            && $record->getTtl() == $this->ttl
            && $record->getValues() == $this->values;
    }

    public function toJsonData() : array
    {
        return array(
            'rrset_name' => $this->name,
            'rrset_type' => $this->type,
            'rrset_values' => $this->values,
            'rrset_ttl' => $this->ttl,
        );
    }
}
