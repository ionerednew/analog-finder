<?php
abstract class Ionerednew_AnalogFinder_Model_System_Config_Source_Abstract
{
    /** @var string */
    protected $_modelAlias;

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return Mage::getModel($this->_modelAlias)->getCollection()->toOptionHash();
    }
}
