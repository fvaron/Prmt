<?php
/**
 * This file is part of Promethean_Demo for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Demo
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */

/**
 * Data Helper
 * @package Promethean_Demo
 */
class Promethean_Demo_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @return string
     */
    public function getLastName()
    {
        if (!Mage::getSingleton('customer/session')->isLoggedIn()) {
            return '';
        }
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        return trim($customer->getLastName());
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        if (!Mage::getSingleton('customer/session')->isLoggedIn()) {
            return '';
        }
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        return trim($customer->getFirstName());
    }
}