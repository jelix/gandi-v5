<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2021 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5\Entities;


abstract class AbstractReadOnlyData
{

    protected static $fields = array();

    protected $rawRecord;

    protected function __construct()
    {
    }

    /**
     * Create an object from data retrieved with the web API
     * @param \stdClass $rawRecord
     * @return object
     */
    static function createFromApi($rawRecord)
    {
        $class = static::class;
        $obj = new $class();
        $obj->rawRecord = $rawRecord;
        return $obj;
    }


    public function hasProperty($property)
    {
        return (isset($this->rawRecord->$property));
    }

    public function __get($property)
    {
        if (isset($this->rawRecord->$property)) {
            return $this->rawRecord->$property;
        }
        return null;
    }

}
