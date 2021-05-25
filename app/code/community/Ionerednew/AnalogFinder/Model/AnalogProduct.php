<?php
class Ionerednew_AnalogFinder_Model_AnalogProduct extends Ionerednew_AnalogFinder_Model_AnalogAbstract
{
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
    public function loadByNameAndBrand($name, $brand)
    {
        return $this->getCollection()
            ->addFieldToFilter('name', $name)
            ->addFieldToFilter('brand_id', $brand->getId())
            ->getFirstItem();
    }

    protected function _beforeSave()
    {
        parent::_beforeSave();
        $this->setData('analog_products_skus', implode(',', $this->getData('analog_products_skus')));
        return $this;
    }

    protected function _afterLoad()
    {
        parent::_afterLoad();
        $this->setData('analog_products_skus', explode(',', $this->getData('analog_products_skus')));
        return $this;
    }
}
