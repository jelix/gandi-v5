<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2021 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5\Entities;

/**
 * SharingSpace
 *
 * @property-read string $id
 * @property-read string $name
 * @property-read string $type
 * @property-read boolean $reseller
 * @property-read object $sharing_space
 */
class SharingSpace
{
    protected $_id = '';
    protected $_name = '';
    protected $_type = '';

    protected $_reseller = false;
    protected $_sharing_space;

    /**
     * AutoRenew constructor.
     *
     * @param string $href
     * @param int  $duration
     * @param false  $enabled
     * @param \DateTime[]  $dates
     * @param string  $org_id
     */
    public function __construct($id, $name, $type, $reseller = false)
    {
        $this->_id = $id;
        $this->_name = $name;
        $this->_type = $type;
        $this->_reseller = $reseller;

    }

    /**
     * Create an object from data retrieved with the web API
     * @param \stdClass $rawRecord
     * @return SharingSpace
     */
    static function createFromApi($rawRecord)
    {
        $shsp = new SharingSpace(
            $rawRecord->id,
            $rawRecord->name,
            $rawRecord->type,
            $rawRecord->reseller
        );

        if (isset($rawRecord->sharing_space) && is_object($rawRecord->sharing_space)) {
            $shsp->_sharing_space = $rawRecord->sharing_space;
        }

        return $shsp;
    }

    public function __get($property)
    {
        if (isset($this->{'_'.$property})) {
            return $this->{'_'.$property};
        }
        return null;
    }
}
