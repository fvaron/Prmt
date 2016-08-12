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

    /* Configuration mode de livraison */
    $installer->setConfigData('carriers/flatrate/active', 0);
    $installer->setConfigData('carriers/freeshipping/active', 1);
    $installer->setConfigData('carriers/freeshipping/title', 'Livraison à domicile');
    $installer->setConfigData('carriers/freeshipping/name', 'Gratuit');

    $installer->endSetup();

} catch (Exception $e) {
    // Silence is golden
    Mage::log($e, null, 'local.log', true);
}
