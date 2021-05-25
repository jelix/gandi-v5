<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2021 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5\Entities;

/**
 * AutoRenew informations
 *
 * @property-read \DateTime[] $dates
 * @property-read int $duration
 * @property-read bool $enabled
 * @property-read string $org_id
 * @property-read string $href
 */
class AutoRenew
{
    protected $_href;

    /**
     * @var \DateTime[]
     */
    protected $_dates = array();
    protected $_duration = 1;
    protected $_enabled = false;
    protected $_org_id = '';

    /**
     * AutoRenew constructor.
     *
     * @param string $href
     * @param int  $duration
     * @param false  $enabled
     * @param \DateTime[]  $dates
     * @param string  $org_id
     */
    public function __construct($href, $duration=1, $enabled=false, $dates = array(), $org_id='')
    {
        $this->_href = $href;
        $this->_duration = $duration;
        $this->_enabled = $enabled;
        $this->_dates = $dates;
        $this->_org_id = $org_id;

    }

    /**
     * Create an object from data retrieved with the web API
     * @param \stdClass $rawRecord
     * @return AutoRenew
     */
    static function createFromApi($rawRecord)
    {
        $dates = array();
        if (isset($rawRecord->dates) && is_array($rawRecord->dates)) {
            foreach($rawRecord->dates as $date) {
                $dates[] = new \DateTime($date);
            }
        }

        return new AutoRenew(
            $rawRecord->href,
            $rawRecord->duration,
            $rawRecord->enabled,
            $dates,
            $rawRecord->org_id
        );
    }

    public function __get($property)
    {
        if (isset($this->{'_'.$property})) {
            return $this->{'_'.$property};
        }
        return null;
    }
}
