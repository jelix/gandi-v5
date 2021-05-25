<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2021 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\ApiV5\Entities;


class DomainAvailability
{

    protected $currency = '';
    protected $grid = '';



    /**
     * @var Product[]
     */
    protected $products = array();


    /**
     * @var Tax[]
     */
    protected $taxes = array();

    protected function __construct()
    {

    }

    /**
     * Create an object from data retrieved with the web API
     * @param \stdClass $rawRecord
     * @return DomainAvailability
     */
    static function createFromApi($rawRecord)
    {
        $obj = new DomainAvailability();
        $obj->currency = $rawRecord->currency;
        $obj->grid = $rawRecord->grid;

        if (isset($rawRecord->products) && is_array($rawRecord->products)) {
            foreach ($rawRecord->products as $prod) {
                $obj->products[] = Product::createFromApi($prod);
            }
        }

        if (isset($rawRecord->taxes) && is_array($rawRecord->taxes)) {
            foreach ($rawRecord->taxes as $tax) {
                $obj->taxes[] = Tax::createFromApi($tax);
            }
        }

        return $obj;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getGrid()
    {
        return $this->grid;
    }

    /**
     * @return Product[]
     */
    public function getProduct()
    {
        return $this->products;
    }

    /**
     * @return Tax[]
     */
    public function getTaxes()
    {
        return $this->taxes;
    }

}
