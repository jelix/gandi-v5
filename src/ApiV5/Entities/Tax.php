<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2021 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5\Entities;

/**
 * Class Tax
 * @property-read $rate
 * @property-read $name
 * @property-read $type
 */
class Tax extends AbstractReadOnlyData
{

    protected static $fields = array('rate',
        'name', 'type'
    );

}
