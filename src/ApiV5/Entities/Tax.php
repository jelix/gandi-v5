<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2021 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5\Entities;

/**
 * Class Tax
 * @property-read float $rate
 * @property-read string $name
 * @property-read string $type
 */
class Tax extends AbstractReadOnlyData
{

    protected static $fields = array('rate',
        'name', 'type'
    );

}
