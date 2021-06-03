<?php

$installer = $this;
$installer->startSetup();

try {
    $connection = $installer->getConnection();
    $connection->dropForeignKey(
        $installer->getTable('analogFinder/analogProduct'),
        $installer->getFkName(
            'analogFinder/analogProduct',
            'brand_id',
            'analogFinder/analogBrand',
            'entity_id'
        )
    );
    $connection->addForeignKey(
        $installer->getFkName(
            'analogFinder/analogProduct',
            'brand_id',
            'analogFinder/analogBrand',
            'entity_id'
        ),
        $installer->getTable('analogFinder/analogProduct'),
        'brand_id',
        $installer->getTable('analogFinder/analogBrand'),
        'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    );

} catch (Exception $e) {
    Mage::logException($e);
}

$installer->endSetup();
