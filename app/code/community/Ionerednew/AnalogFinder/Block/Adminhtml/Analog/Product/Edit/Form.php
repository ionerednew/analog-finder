<?php
class Ionerednew_AnalogFinder_Block_Adminhtml_Analog_Product_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Prepare the form
     *
     * @return Mage_Adminhtml_Block_Widget_Form|void
     */
    protected function _prepareForm()
    {
        $helper = Mage::helper('analogFinder');

        $form = new Varien_Data_Form([
            'id'      => 'edit_form',
            'action'  => $this->getUrl('*/*/save', ['id' => $this->getRequest()->getParam('id')]),
            'method'  => 'post',
            'enctype' => 'multipart/form-data',
        ]);
        $form->setUseContainer(true);

        $fieldset = $form->addFieldset('edit_item', [
            'legend' => $helper->__('Product data')
        ]);

        $fieldset->addField('name', 'text', [
            'label'    => $helper->__('Name'),
            'name'     => 'name',
            'required' => true,
        ]);

        $fieldset->addField('brand_id', 'select', [
            'label'    => $helper->__('Brand'),
            'name'     => 'brand_id',
            'options'  => Mage::getSingleton('analogFinder/system_config_source_brand')->toArray(),
        ]);

        $fieldset->addField('analog_products_skus', 'text', [
            'label'    => $helper->__('Analog products skus'),
            'name'     => 'analog_products_skus',
            'required' => true,
        ]);

        $fieldset->addField('is_active', 'select', [
            'label'    => $helper->__('Enabled'),
            'name'     => 'is_active',
            'options'  => Mage::getSingleton('adminhtml/system_config_source_yesno')->toArray(),
        ]);

        if ($data = Mage::registry('current_model')) {
            $form->setValues($data->getData());
        }
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
