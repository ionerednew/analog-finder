<?php
require_once 'abstract.php';
require_once dirname(__FILE__) . '/../vendor/autoload.php';

class Ionerednew_Shell_SetAnalogsDataByFile extends Mage_Shell_Abstract
{
    const BRAND_NAME_COL = 0,
        PRODUCT_NAME_COL = 1,
        ANALOG_PRODUCT_SKUS_COL = 2,
        DATA_MODE_COL = 3;

    const ADD_DATA_MODE = 'add',
        SET_DATA_MODE = 'set';

    const BRAND_MODEL_ALIAS = 'analogFinder/analogBrand',
        PRODUCT_MODEL_ALIAS = 'analogFinder/analogProduct';

    /**
     * Run script
     *
     * @return void
     */
    public function run()
    {
        if (!$this->getArg('file')) {
            echo $this->usageHelp();
            return;
        }
        $file = $this->getArg('file');
        $csvObject = new Varien_File_Csv();
        $csvObject->setDelimiter(';');
        $items = $csvObject->getData($file);
        $this->_processData($this->_prepareData($items));
    }

    private function _processData($data)
    {
        foreach ($data as $brandName => $productsData) {
            try {
                $brand = $this->_getBrand($brandName);
                foreach ($productsData as $productName => $analogProductsData) {
                    $product = $this->_getProduct($productName, $brand->getName());
                    foreach ($analogProductsData as $mode => $analogProductsSkus) {
                        if ($mode == self::ADD_DATA_MODE) {
                            $currentAnalogProductsSkus = $product->getAnalogProductsSkus();
                            $mergedProductSkus = array_unique(array_merge($currentAnalogProductsSkus, $analogProductsSkus));
                            $product->setAnalogProductsSkus($mergedProductSkus)->save();
                            continue;
                        }
                        $product->setAnalogProductsSkus($analogProductsSkus)->save();
                    }
                }
            } catch (Exception $e) {
                Mage::logException($e);
            }
        }
    }

    private function _prepareData($items)
    {
        $data = [];
        foreach ($items as $item) {
            $brandName = $item[self::BRAND_NAME_COL];
            $productName = $item[self::PRODUCT_NAME_COL];
            $analogProductsSkus = $item[self::ANALOG_PRODUCT_SKUS_COL];
            $mode = $item[self::DATA_MODE_COL] == self::ADD_DATA_MODE ? self::ADD_DATA_MODE : self::SET_DATA_MODE;
            if (!$brandName || !$productName || !$analogProductsSkus) {
                continue;
            }
            $data[$brandName][$productName] = [$mode => explode(',', $analogProductsSkus)];
        }
        return $data;
    }

    /**
     * @return mixed
     */
    private function _createEntity($entity, $name, $entityType)
    {
        $entity->setName($name)->setIsActive(1)->save();
        echo "Saved and activated new {$entityType} '{$name}' !!!\n";
        return $entity;
    }

    /**
     * Get brand
     *
     * @param string $brandName
     * @return Ionerednew_AnalogFinder_Model_AnalogBrand
     */
    private function _getBrand(string $brandName)
    {
        $brand = Mage::getModel(self::BRAND_MODEL_ALIAS)->loadByName($brandName);
        return $this->_getEntity($brand, $brandName, 'brand');
    }

    private function _getProduct(string $productName, string $brandName)
    {
        $product = Mage::getModel(self::PRODUCT_MODEL_ALIAS)->loadByNameAndBrand($productName, $brandName);
        return $this->_getEntity($product, $productName, 'product');
    }

    private function _getEntity($loadedEntity, $name, $entityType)
    {
        if (!$loadedEntity->isObjectNew()) {
            return $loadedEntity;
        }
        return $this->_createEntity($loadedEntity, $name, $entityType);
    }


    /**
     * Retrieve Usage Help Message
     *
     */
    public function usageHelp()
    {
        return <<<USAGE
Usage:  php setAnalogsDataByFile.php --file <file>

USAGE;
    }
}

$shell = new Ionerednew_Shell_SetAnalogsDataByFile();
$shell->run();
