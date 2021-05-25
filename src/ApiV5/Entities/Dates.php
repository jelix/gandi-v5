<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2021 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5\Entities;

/**
 * Class Dates
 *
 * @property-read \DateTime $registry_created_at
 * @property-read \DateTime $updated_at
 * @property-read \DateTime $authinfo_expires_at
 * @property-read \DateTime $created_at
 * @property-read \DateTime $deletes_at
 * @property-read \DateTime $hold_begins_at
 * @property-read \DateTime $hold_ends_at
 * @property-read \DateTime $pending_delete_ends_at
 * @property-read \DateTime $registry_ends_at
 * @property-read \DateTime $renew_begins_at
 * @property-read \DateTime $restore_ends_at
 */
class Dates
{
    /**
     * @var \DateTime
     */
    protected $_registry_created_at;
    /**
     * @var \DateTime
     */
    protected $_updated_at;

    /**
     * @var \DateTime
     */
    protected $_authinfo_expires_at;
    /**
     * @var \DateTime
     */
    protected $_created_at;
    /**
     * @var \DateTime
     */
    protected $_deletes_at;
    /**
     * @var \DateTime
     */
    protected $_hold_begins_at;
    /**
     * @var \DateTime
     */
    protected $_hold_ends_at;
    /**
     * @var \DateTime
     */
    protected $_pending_delete_ends_at;
    /**
     * @var \DateTime
     */
    protected $_registry_ends_at;
    /**
     * @var \DateTime
     */
    protected $_renew_begins_at;
    /**
     * @var \DateTime
     */
    protected $_restore_ends_at;

    /**
     * ContactDates constructor.
     *
     * @param \DateTime|string $registry_created_at
     * @param \DateTime|string $updated_at
     */
    public function __construct($registry_created_at, $updated_at)
    {
        if (is_string($registry_created_at)) {
            $registry_created_at = new \DateTime($registry_created_at);
        }
        if (is_string($updated_at)) {
            $updated_at = new \DateTime($updated_at);
        }
        $this->_registry_created_at = $registry_created_at;
        $this->_updated_at = $updated_at;
    }

    /**
     * Create a ContactDates object from data retrieved with the web API
     * @param \stdClass $rawRecord
     * @return Dates
     */
    static function createFromApi($rawRecord)
    {
        $dates = new Dates(
            $rawRecord->registry_created_at,
            $rawRecord->updated_at
        );

        foreach(array('authinfo_expires_at', 'created_at', 'deletes_at',
            'hold_begins_at', 'hold_ends_at', 'pending_delete_ends_at',
            'registry_ends_at', 'renew_begins_at', 'restore_ends_at'
            ) as $field) {

            if (isset($rawRecord->$field)) {
                $dates->{'_'.$field} = new \DateTime($rawRecord->$field);
            }
        }
        return $dates;
    }

    public function __get($property)
    {
        if (isset($this->{'_'.$property})) {
            return $this->{'_'.$property};
        }
        return null;
    }
}
