<?php
abstract class Ionerednew_AnalogFinder_Adminhtml_Analog_AbstractController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @var string
     */
    protected $_modelAlias;

    /**
     * @var string
     */
    protected $_resourceName;

    /**
     * Show brands grid
     *
     * @return void
     */
    public function indexAction()
    {
        $this->loadLayout()
            ->renderLayout();
    }

    /**
     * New brand action
     *
     * @return void
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Show brands grid
     *
     * @return void
     */
    public function gridAction()
    {
        $this->loadLayout()
            ->renderLayout();
    }

    /**
     * Show brands grid
     *
     * @throws Exception
     * @return void
     */
    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $model = $this->_getModel()->load($id);
            Mage::register('current_model', $model);

            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This entity is not exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $this->loadLayout()
            ->renderLayout();
    }

    /**
     * Save brand action
     *
     * @return void
     */
    public function saveAction()
    {
        $data = $this->getRequest()->getParams();
        try {
            $model = $this->_getModel();
            if (isset($data['id'])) {
                $model->load($data['id']);
            }
            $model->addData($data);
            $model->save();
        } catch (Exception $e) {
            $this->_getSession()->addError($e->getMessage());
            Mage::logException($e);
        }
        $this->_redirect('*/*/');
    }

    /**
     * Get brand model
     *
     * @return Ionerednew_AnalogFinder_Model_AnalogBrand
     */
    protected function _getModel()
    {
        return Mage::getModel($this->_getModelAlias());
    }

    /**
     * return model alias
     *
     * @return string
     */
    protected function _getModelAlias()
    {
        return $this->_modelAlias;
    }

    /**
     * Is allowed
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('catalog/analogs/' . $this->_resourceName);
    }

    /**
     * delete entity
     *
     * @return void
     */
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $this->_getModel()->load($id)->delete();
                $this->_getSession()->addSuccess($this->__('Successfully deleted.'));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $this->_redirect('*/*/edit', ['id' => $id]);
            }
        }
        $this->_redirect('*/*/');
    }
}
