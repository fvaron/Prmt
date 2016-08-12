<?php
/**
 * This file is part of Promethean_Faq for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Faq
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */

try {
    /* @var $installer Mage_Core_Model_Resource_Setup */
    $installer = $this;
    $installer->startSetup();

    $tableName = $installer->getTable('faq/cat_store');
    if (!$installer->tableExists($tableName)) {

        /**
         * Create table 'faq_categories_store'
         */
        $table = $installer->getConnection()
            ->newTable($tableName)
            ->addColumn(
                'cat_id',
                Varien_Db_Ddl_Table::TYPE_INTEGER,
                null,
                array(
                    'primary' => true,
                    'unsigned' => true,
                    'nullable' => false
                ),
                'Category Id'
            )
            ->addColumn(
                'store_id',
                Varien_Db_Ddl_Table::TYPE_INTEGER,
                null,
                array(
                    'primary' => true,
                    'unsigned' => true,
                    'nullable' => false
                ),
                'Store Id'
            )
            ->addForeignKey(
                $installer->getFkName('faq/cat_store', 'cat_id', 'faq/cat', 'id'),
                'cat_id',
                $installer->getTable('faq/cat'),
                'id',
                Varien_Db_Ddl_Table::ACTION_CASCADE,
                Varien_Db_Ddl_Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $installer->getFkName('faq/cat_store', 'store_id', 'core/store', 'store_id'),
                'store_id',
                $installer->getTable('core/store'),
                'store_id',
                Varien_Db_Ddl_Table::ACTION_CASCADE,
                Varien_Db_Ddl_Table::ACTION_CASCADE
            )
            ->setComment('Faq Categories/Store Relations');
        $installer->getConnection()->createTable($table);
    }

    $installer->endSetup();
} catch (Exception $e) {
    Mage::logException($e);
}