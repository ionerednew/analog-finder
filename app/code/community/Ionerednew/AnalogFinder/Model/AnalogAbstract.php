<?php
abstract class Ionerednew_AnalogFinder_Model_AnalogAbstract extends Mage_Core_Model_Abstract
{
    /**
     * Load model by name
     *
     * @param string $name name
     * @return Mage_Core_Model_Abstract
     */
    public function loadByName($name)
    {
        return $this->load($name, 'name');
    }

    /**
     * get name without spaces
     *
     * @return string
     */
    public function getName()
    {
        return ltrim($this->getData('name'));
    }
}
