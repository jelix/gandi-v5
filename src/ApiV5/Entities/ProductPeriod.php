<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2021 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5\Entities;

/**
 * @property-read string $name
 * @property-read string $starts_at
 * @property-read string $ends_at
 */
class ProductPeriod extends AbstractReadOnlyData
{

    protected static $fields = array('starts_at',
        'name', 'ends_at'
    );

    /**
     * @return \DateTime|null
     * @throws \Exception
     */
    public function getStartsAtDateTime()
    {
        if (isset($this->rawRecord->starts_at)) {
            return new \DateTime($this->rawRecord->starts_at);
        }
        return null;
    }

    /**
     * @return \DateTime|null
     * @throws \Exception
     */
    public function getEndsAtDateTime()
    {
        if (isset($this->rawRecord->ends_at)) {
            return new \DateTime($this->rawRecord->ends_at);
        }
        return null;
    }
}
