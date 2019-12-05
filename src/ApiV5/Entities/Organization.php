<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5\Entities;


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
     * Organization constructor
     */
    function __construct($name, $id, $type)
    {
        $this->name = $name;
        $this->type = $type;
        $this->id = $id;
    }

    /**
     * Create an Organisation object from data retrieved with the web API
     * @param \stdClass $rawOrg
     */
    static function createFromApi($rawOrg)
    {
        return new Organization(
            $rawOrg->name,
            $rawOrg->id,
            $rawOrg->type
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
