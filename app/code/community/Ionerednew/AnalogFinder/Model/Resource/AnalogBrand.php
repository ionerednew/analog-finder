<?php
class Ionerednew_AnalogFinder_Model_Resource_AnalogBrand extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Init the table
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('analogFinder/analogBrand', 'entity_id');
    }
}
