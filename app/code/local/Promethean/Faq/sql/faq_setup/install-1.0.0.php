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

    $tableName = $installer->getTable('faq/faq');
    if (!$installer->tableExists($tableName)) {

        /**
         * Create table 'faq/faq'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('faq/faq'))
            ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true,
            ), 'Id')
            ->addColumn('cat_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                'nullable' => false,
            ), 'FAQ Category ID')
            ->addColumn('sort', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                'nullable' => true,
            ), 'Question Sort Order')
            ->addColumn('question', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
                'nullable' => false,
            ), 'Question')
            ->addColumn('response', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
                'nullable' => false,
            ), 'Answer')
            ->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
                'nullable' => false,
                'default' => '1',
            ), 'Is Question Visible')
            ->addColumn('is_most_frequently_asked', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                'nullable' => false,
                'default' => 0,
            ), 'Is most frequently asked question flag')
            ->setComment('FAQ Questions');

        $installer->getConnection()->createTable($table);
    }

    $tableName = $installer->getTable('faq/cat');
    if (!$installer->tableExists($tableName)) {
        /**
         * Create table 'faq/cat'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('faq/cat'))
            ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true,
            ), 'Id')
            ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
                'nullable' => false,
            ), 'Category Name')
            ->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
                'nullable' => false,
                'default' => '1',
            ), 'Is Category Active')
            ->setComment('FAQ Categories');

        $installer->getConnection()->createTable($table);
    }

    $installer->endSetup();

} catch (Exception $e) {
    Mage::logException($e);
}
