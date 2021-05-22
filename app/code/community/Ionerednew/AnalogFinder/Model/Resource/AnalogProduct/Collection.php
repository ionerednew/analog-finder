<?php
class Ionerednew_AnalogFinder_Model_Resource_AnalogProduct_Collection
    extends Ionerednew_AnalogFinder_Model_Resource_Abstract_Collection
{
    protected $_modelAlias = 'analogFinder/analogProduct';

    /**
     * Filter collection by brand id
     *
     * @param int $brandId brand id
     * @return $this
     */
    public function filterByBrandId($brandId)
    {
        return $this->addFieldToFilter('brand_id', $brandId);
    }

    /**
     * return column values brand_id
     *
     * @return array
     */
    public function getBrandIds()
    {
        return $this->getColumnValues('brand_id');
    }
}
