<?php
class Ionerednew_AnalogFinder_Block_Adminhtml_Analog_Brand extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Init grid container
     */
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'adminhtml_analog_brand';
        $this->_blockGroup = 'analogFinder';
        $this->_headerText = $this->__('Analog brands');
    }
}
