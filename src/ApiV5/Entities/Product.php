<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2021 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5\Entities;


class Product
{
    protected $name = '';

    protected $status = '';

    /**
     * @var ProductPrice[]
     */
    protected $prices =array();

    /**
     * @var Tax[]
     */
    protected $taxes = array();

    /**
     * @var ProductPeriod[]
     */
    protected $periods = array();

    protected $process = '';


    protected function __construct($name, $status)
    {
        $this->name = $name;
        $this->status = $status;
    }


    /**
     * Create an object from data retrieved with the web API
     * @param \stdClass $rawRecord
     * @return Product
     */
    static function createFromApi($rawRecord)
    {
        $prod = new Product(
            $rawRecord->name,
            $rawRecord->status
        );

        if (isset($rawRecord->prices) && is_array($rawRecord->prices)) {
            foreach ($rawRecord->prices as $price) {
                $prod->prices[] = ProductPrice::createFromApi($price);
            }
        }

        if (isset($rawRecord->taxes) && is_array($rawRecord->taxes)) {
            foreach ($rawRecord->taxes as $tax) {
                $prod->taxes[] = Tax::createFromApi($tax);
            }
        }

        if (isset($rawRecord->periods) && is_array($rawRecord->periods)) {
            foreach ($rawRecord->periods as $period) {
                $prod->periods[] = ProductPeriod::createFromApi($period);
            }
        }

        if (isset($rawRecord->process)) {
            $prod->process = $rawRecord->process;
        }
        return $prod;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return ProductPrice[]
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @return Tax[]
     */
    public function getTaxes()
    {
        return $this->taxes;
    }

    /**
     * @return ProductPeriod[]
     */
    public function getPeriods()
    {
        return $this->periods;
    }

}
