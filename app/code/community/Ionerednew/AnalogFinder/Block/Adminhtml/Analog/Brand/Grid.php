<?php
class Ionerednew_AnalogFinder_Block_Adminhtml_Analog_Brand_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Init grid
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('brandGrid');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);

        $this->setModelPath('analogFinder/analogBrand');
        $this->setIdFieldName(Mage::getModel($this->getModelPath())->getResource()->getIdFieldName());
    }

    /**
     * Prepare collection for grid
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel($this->getModelPath())->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * prepare grid columns
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn($this->getIdFieldName(), [
            'header' => $this->__('ID'),
            'align'  => 'left',
            'width'  => '220px',
            'type'   => 'int',
            'index'  => $this->getIdFieldName()
        ]);

        $this->addColumn('name', [
            'header' => $this->__('Name'),
            'type'   => 'text',
            'align'  => 'right',
            'index'  => 'name'
        ]);

        $this->addColumn('is_active', [
            'header'  => $this->__('Enabled'),
            'align'   => 'right',
            'width'   => '50px',
            'type'    => 'options',
            'options' => Mage::getSingleton('adminhtml/system_config_source_yesno')->toArray(),
            'index'   => 'is_active'
        ]);

        return parent::_prepareColumns();
    }

    /**
     * get the row url for edit
     *
     * @param Varien_Object $row row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', ['id' => $row->getId()]);
    }

    /**
     * get the grid url for ajax updates
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', ['_current' => true]);
    }
}
