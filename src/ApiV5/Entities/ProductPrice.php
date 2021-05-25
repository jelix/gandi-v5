<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2021 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5\Entities;

/**
 * Class ProductPrice
 *
 * @property-read string $duration_unit
 * @property-read int $max_duration
 * @property-read int $min_duration
 * @property-read float $price_after_taxes
 * @property-read float $price_before_taxes
 * @property-read boolean $discount
 * @property-read float $normal_price_after_taxes
 * @property-read float $normal_price_before_taxes
 * @property-read string $type
 * @property-read object $options
 */
class ProductPrice extends AbstractReadOnlyData
{

    protected static $fields = array('duration_unit',
        'max_duration', 'min_duration', 'price_after_taxes',
        'price_before_taxes', 'discount', 'normal_price_after_taxes',
        'normal_price_before_taxes', 'type',
        'options'
    );

}
