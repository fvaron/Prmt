<?php
/**
 * This file is part of Promethean_Checkout for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Checkout
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */
class Promethean_Checkout_Model_Observer
{
    /**
     * @param Varien_Event_Observer $observer
     */
    public function saveOrder(Varien_Event_Observer $observer)
    {
        $controllerAction = $observer->getEvent()->getControllerAction();
        $response = $controllerAction->getResponse();
        $paymentResponse = Mage::helper('core')->jsonDecode($response->getBody());
        if (!isset($paymentResponse['error']) || !$paymentResponse['error']) {
            $controllerAction->getRequest()->setParam('form_key', Mage::getSingleton('core/session')->getFormKey());
            $controllerAction->getRequest()->setPost('agreement', array_flip(Mage::helper('checkout')->getRequiredAgreementIds()));
            $controllerAction->saveOrderAction();
            $orderResponse = Mage::helper('core')->jsonDecode($response->getBody());
            if ($orderResponse['error'] === false && $orderResponse['success'] === true) {
                if (!isset($orderResponse['redirect']) || !$orderResponse['redirect']) {
                    $orderResponse['redirect'] = Mage::getUrl('*/*/success');
                }
                $controllerAction->getResponse()->setBody(Mage::helper('core')->jsonEncode($orderResponse));
            }
        }
    }
}