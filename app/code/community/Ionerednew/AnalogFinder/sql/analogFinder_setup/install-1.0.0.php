<?php
$installer = $this;
$installer->startSetup();

try {
    $connection = $installer->getConnection();
    $table = $connection
        ->newTable($installer->getTable('analogFinder/analogBrand'))
        ->addColumn(
            'entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, [
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary'  => true,
        ], 'ID')
        ->addColumn(
            'name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, [], 'Name'
        )
        ->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, [
            'unsigned' => true,
            'nullable' => false,
            'default'  => '1'
        ], 'Enabled')
        ->setComment('Analog brand table');

    $connection->createTable($table);

    $table = $connection
        ->newTable($installer->getTable('analogFinder/analogProduct'))
        ->addColumn(
            'entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, [
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary'  => true,
        ], 'ID')
        ->addColumn(
            'name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, [], 'Name'
        )
        ->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, [
            'unsigned' => true,
            'nullable' => false,
            'default'  => '1'
        ], 'Enabled')
        ->addColumn(
            'brand_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, [], 'Brand ID'
        )
        ->addColumn('analog_product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, [
            'unsigned' => true,
            'nullable' => false
        ], 'Enabled')
        ->addForeignKey(
            $installer->getFkName(
                'analogFinder/analogProduct',
                'brand_id',
                'analogFinder/analogBrand',
                'entity_id'
            ),
            'brand_id',
            $installer->getTable('analogFinder/analogBrand'),
            'entity_id',
            Varien_Db_Ddl_Table::ACTION_SET_NULL,
            Varien_Db_Ddl_Table::ACTION_CASCADE
        )
        ->setComment('Analog product table');

    $connection->createTable($table);

} catch (Exception $e) {
    Mage::logException($e);
}

$installer->endSetup();
