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

    /* @var $installer Mage_Customer_Model_Entity_Setup */
    $installer = $this;
    $installer->startSetup();

    /**
     * Attribute téléphone mobile
     * mobile
     */
    $installer->addAttribute('customer_address', 'mobile', array(
        "label" => "Téléphone mobile",
        "visible" => true,
        "required" => false,
        "user_defined" => true,
        "type" => "varchar",
        "input" => "text"
    ));

    Mage::getSingleton('eav/config')
        ->getAttribute('customer_address', 'mobile')
        ->setData('used_in_forms', array('customer_register_address','customer_address_edit','adminhtml_customer_address'))
        ->save();

    $installer->endSetup();

} catch (Exception $e) {
    // Silence is golden
}
