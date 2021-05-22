<?php
class Ionerednew_AnalogFinder_Block_Search extends Mage_Core_Block_Template
{
    public function getAvailableBrands()
    {
        return $this->helper('analogFinder')->getAvailableBrands();
    }
}