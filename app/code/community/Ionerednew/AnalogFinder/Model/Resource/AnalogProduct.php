<?php
class Ionerednew_AnalogFinder_Model_Resource_AnalogProduct extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Init the table
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('analogFinder/analogProduct', 'entity_id');
    }
}
