<?php
require_once Mage::getModuleDir('controllers', 'Ionerednew_AnalogFinder') .
    DS . 'Adminhtml' . DS . 'Analog' . DS . 'AbstractController.php';

class Ionerednew_AnalogFinder_Adminhtml_Analog_ProductController extends Ionerednew_AnalogFinder_Adminhtml_Analog_AbstractController
{
    protected $_resourceName = 'product';
    protected $_modelAlias   = 'analogFinder/analogProduct';
}
