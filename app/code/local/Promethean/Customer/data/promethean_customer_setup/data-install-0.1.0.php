<?php
/**
 * This file is part of Promethean_Customer for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Customer
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */

try {

    $installer = $this;

    /**
     * Update Customer Attribute MiddleName (hide)
     */
    $installer->setConfigData('customer/address/middlename_show', 0);
    $installer->updateAttribute('customer', 'middlename', 'is_visible', 0);
    $installer->updateAttribute('customer_address', 'middlename', 'is_visible', 0);

    /**
     * Update Customer Attribute Prefix (show)
     */
    $installer->setConfigData('customer/address/prefix_show', 'opt');
    $installer->setConfigData('customer/address/prefix_options', 'Mle.;Mr.');
    $installer->updateAttribute('customer', 'prefix', 'is_visible', 1);
    /**
     * Display tax
     */
    $installer->setConfigData('customer/address/taxvat_show', 'opt');
    $installer->setConfigData('customer/create_account/vat_frontend_visibility', 1);



} catch (Exception $e) {
    Mage::log($e, null, 'local.log', true);
}