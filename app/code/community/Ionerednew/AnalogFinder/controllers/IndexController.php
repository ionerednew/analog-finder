<?php
class Ionerednew_AnalogFinder_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * index action
     *
     * @return void
     */
    public function indexAction()
    {
        $this->loadLayout()->renderLayout();
    }

    public function getProductsAction()
    {
       $data = $this->getRequest()->getParam('brand');
       if (!$id = $data['id']) {
           return;
       }
       $response = Mage::getModel('ajax/response');
       try {
           /** @var Ionerednew_AnalogFinder_Helper_Data $helper */
           $helper = Mage::helper('analogFinder');

           $products = $helper->getAvailableProducts()->filterByBrandId($id);
           $this->loadLayout();
           $content = $this->getLayout()->getBlock('products.select')->setAvailableProducts($products)->toHtml();
           $response->success()->setContent($content);
       } catch (Mage_Core_Exception $e) {
           $response->error()->setMessage($e->getMessage());
       } catch(Exception $e) {
           $response->error()->setMessage($e->getMessage());
           Mage::logException($e);
       }
       Mage::helper('ajax')->sendResponse($response);
    }

    public function getAnalogProductAction()
    {
        $data = $this->getRequest()->getParam('product');
        if (!$id = $data['id']) {
            return;
        }
        $response = Mage::getModel('ajax/response');
        try {
            /** @var Ionerednew_AnalogFinder_Helper_Data $helper */
            $helper = Mage::helper('analogFinder');
            $product = Mage::getModel('catalog/product')->load($id);
            $this->loadLayout();
            $content = $this->getLayout()->getBlock('analog.product')->setProduct($product)->toHtml();
            $response->success()->setContent($content);
        } catch (Mage_Core_Exception $e) {
            $response->error()->setMessage($e->getMessage());
        } catch(Exception $e) {
            $response->error()->setMessage($e->getMessage());
            Mage::logException($e);
        }
        Mage::helper('ajax')->sendResponse($response);
    }
}
