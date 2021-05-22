<?php
class Ionerednew_AnalogFinder_Block_Adminhtml_Analog_Product_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init
     *
     * @return $this
     */
    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_analog_product';
        $this->_blockGroup = 'analogFinder';
        $this->_headerText = $this->__('View product');
        parent::__construct();
    }
}
