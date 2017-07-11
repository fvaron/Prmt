<?php
/**
 * This file is part of Promethean_System for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_System
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */

try {

    /* @var $installer Mage_Core_Model_Resource_Setup */
    $installer = $this;
    $installer->startSetup();

    /* Configuration tva */
    $installer->setConfigData('tax/classes/shipping_tax_class', 2);
    $installer->setConfigData('tax/defaults/country', 'FR');
    $installer->setConfigData('tax/cart_display/full_summary', 1);
    $installer->setConfigData('tax/sales_display/full_summary', 1);


    $installer->endSetup();

} catch (Exception $e) {
    // Silence is golden
    Mage::log($e, null, 'local.log', true);
}