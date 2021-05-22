<?php
abstract class Ionerednew_AnalogFinder_Model_Resource_Abstract_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected $_modelAlias;
    /**
     * Init model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init($this->_modelAlias);
        $this->setAlphabeticallyOrder();
    }

    /**
     * Filter collection by brand id
     *
     * @return $this
     */
    public function filterByActiveStatus()
    {
        return $this->addFieldToFilter('is_active', true);
    }

    /**
     * Filter collection by entity ids
     *
     * @param array $ids ids
     * @return Mage_Eav_Model_Entity_Collection_Abstract
     */
    public function addIdFilter($ids)
    {
        return $this->addFieldToFilter('entity_id', ['in' => $ids]);
    }

    /**
     * To option hash
     *
     * @return array
     */
    public function toOptionHash()
    {
        return $this->_toOptionHash('entity_id');
    }

    /**
     * return collection ordered alphabetically
     *
     * @return Ionerednew_AnalogFinder_Model_Resource_Abstract_Collection
     */
    public function setAlphabeticallyOrder()
    {
        $this->setOrder('name', Zend_Db_Select::SQL_ASC);
    }
}

