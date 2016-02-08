<?php
/**
 * This file is part of Promethean_Paypal for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Paypal
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */

/**
 * Observer Model
 * @package Promethean_Paypal
 */
class Promethean_Paypal_Model_Observer extends Mage_Core_Model_Abstract
{
    /**
     * @param Varien_Event_Observer $observer
     */
    public function controllerActionPredispatchPaypalExpressReview(Varien_Event_Observer $observer)
    {
        Mage::app()->getResponse()->setRedirect(Mage::getUrl('*/*/placeOrder'));
    }

    /**
     * @param Varien_Event_Observer $observer
     */
    public function controllerActionPredispatchPaypalExpressPlaceOrder(Varien_Event_Observer $observer)
    {
        $requiredAgreements = Mage::helper('checkout')->getRequiredAgreementIds();
        $postedAgreements = array_fill_keys($requiredAgreements, 1);
        Mage::app()->getRequest()->setPost('agreement', $postedAgreements);
    }
}