<?php
/**
 * This file is part of Promethean_Request4quote for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Request4quote
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$installer->getConnection()->addColumn($installer->getTable('request4quote/quote'), 'expiration_date',array(
    'type'  =>  Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
    'comment'   =>  'Expiration Date'));

$installer->endSetup();