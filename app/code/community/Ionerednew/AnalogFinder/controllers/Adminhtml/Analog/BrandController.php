<?php
require_once Mage::getModuleDir('controllers', 'Ionerednew_AnalogFinder') .
    DS . 'Adminhtml' . DS . 'Analog' . DS . 'AbstractController.php';

class Ionerednew_AnalogFinder_Adminhtml_Analog_BrandController extends Ionerednew_AnalogFinder_Adminhtml_Analog_AbstractController
{
    protected $_resourceName = 'brand';
    protected $_modelAlias   = 'analogFinder/analogBrand';
}
