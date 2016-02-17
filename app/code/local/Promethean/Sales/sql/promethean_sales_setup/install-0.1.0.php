<?php
/**
 * This file is part of Promethean_Sales for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Sales
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */

try {

    /* @var $installer Mage_Sales_Model_Entity_Setup */
    $installer = $this;
    $installer->startSetup();

    $conn = $installer->getConnection();
    /* @var $conn Varien_Db_Adapter_Pdo_Mysql */

    $conn->addColumn($installer->getTable('sales/quote_address'), 'mobile', 'varchar(255) after telephone');
    $conn->addColumn($installer->getTable('sales/order_address'), 'mobile', 'varchar(255) after telephone');


    $installer->endSetup();

} catch (Exception $e) {
    Mage::log($e, null, 'local.log', true);
}
