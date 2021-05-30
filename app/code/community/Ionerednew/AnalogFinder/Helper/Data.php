<?php
class Ionerednew_AnalogFinder_Helper_Data extends Mage_Core_Helper_Data
{
    /**
     * @var Ionerednew_AnalogFinder_Model_Resource_AnalogBrand_Collection
     */
    private $_brands;

    /**
     * @var Ionerednew_AnalogFinder_Model_Resource_AnalogProduct_Collection
     */
    private $_products;

    /**
     * @var array
     */
    private $_availableBrandIds;

    /**
     * Get available brands
     *
     * @return Ionerednew_AnalogFinder_Model_Resource_AnalogBrand_Collection
     */
    public function getAvailableBrands()
    {
        if (!$this->_brands) {
            $this->_brands = Mage::getModel('analogFinder/analogBrand')
                ->getCollection()
                ->filterByActiveStatus()
                ->addIdFilter($this->_getBrandIds());
        }
        return $this->_brands;
    }

    /**
     * Get available products
     *
     * @return Ionerednew_AnalogFinder_Model_Resource_AnalogProduct_Collection
     */
    public function getAvailableProducts()
    {
        if (!$this->_products) {
            $this->_products = Mage::getModel('analogFinder/analogProduct')
                ->getCollection()
                ->filterByActiveStatus();
        }
        return $this->_products;
    }

    /**
     * Get available brand ids
     *
     * @return array
     */
    private function _getBrandIds()
    {
        if (!$this->_availableBrandIds) {
            $this->_availableBrandIds = array_unique($this->getAvailableProducts()->getBrandIds());
        }
        return $this->_availableBrandIds;
    }
}
