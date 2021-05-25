<?php
class Ionerednew_AnalogFinder_Model_AnalogProduct extends Ionerednew_AnalogFinder_Model_AnalogAbstract
{
    private $_analogSkus;

    /**
     * Constructor
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('analogFinder/analogProduct');
    }

    /**
     * @param $name
     * @param $brand
     * @return Ionerednew_AnalogFinder_Model_AnalogProduct
     */
    public function loadByNameAndBrandId($name, $brandId)
    {
        return $this->getCollection()
            ->addFieldToFilter('name', $name)
            ->addFieldToFilter('brand_id', $brandId)
            ->getFirstItem();
    }

    public function getAnalogSkus()
    {
        if (!empty($this->_analogSkus)) {
            return $this->_analogSkus;
        }
        return $this->_analogSkus = explode(',', $this->getData('analog_products_skus'));
    }

    public function setAnalogSkus(array $analogSkus)
    {
        $this->_analogSkus = $analogSkus;
        $this->setData('analog_products_skus', implode(',', $this->_analogSkus));
        return $this;
    }
}
