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
 * @property-read $duration_unit
 * @property-read $max_duration
 * @property-read $min_duration
 * @property-read $price_after_taxes
 * @property-read $price_before_taxes
 * @property-read $discount
 * @property-read $normal_price_after_taxes
 * @property-read $normal_price_before_taxes
 * @property-read $type
 * @property-read $options
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
