<?php
class Ionerednew_AnalogFinder_Block_Adminhtml_Analog_Brand_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init
     *
     * @return $this
     */
    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_analog_brand';
        $this->_blockGroup = 'analogFinder';
        $this->_headerText = $this->__('View brand');
        parent::__construct();
    }
}
