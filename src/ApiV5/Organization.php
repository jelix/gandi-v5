<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5;


class Organization
{
    protected $name = '';
    protected $firstname = '';
    protected $lastname = '';
    protected $id = '';
    protected $corporate = false;
    protected $type = '';
    protected $email = '';

    /**
     * ZoneRecord constructor
     */
    function __construct($name, $id, $type)
    {
        $this->name = $name;
        $this->type = $type;
        $this->id = $id;

    }

    /**
     * Create a ZoneRecord object from data retrieved with the web API
     * @param \stdClass $rawRecord
     */
    static function createFromApi($rawRecord)
    {
        return new Organization(
            $rawRecord->name,
            $rawRecord->id,
            $rawRecord->type
        );
    }

    public function getName() {
        return $this->name;
    }

    public function getType() {
        return $this->type;
    }

    public function getId() {
        return $this->id;
    }

}
