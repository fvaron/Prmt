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

    /* Désactivation mode invité */
    $installer->setConfigData('checkout/options/guest_checkout', 0);
    $installer->setConfigData('checkout/options/customer_must_be_logged', 1);

    $installer->endSetup();

} catch (Exception $e) {
    // Silence is golden
    Mage::log($e, null, 'local.log', true);
}