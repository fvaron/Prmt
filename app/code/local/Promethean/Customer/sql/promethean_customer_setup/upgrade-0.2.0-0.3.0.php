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

    /* telephone not required */
    $installer->updateAttribute('customer_address', 'telephone', 'is_required', 0);

    $installer->endSetup();

} catch (Exception $e) {
    // Silence is golden
}
