<?php
/**
 * This file is part of Promethean_Request4quote for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Request4quote
 * @copyright Copyright (c) 2017 Caroline Framery (http://)
 */
class Promethean_Request4quote_Model_Rewrite_Adminhtml_Quote_Create extends ITwebexperts_Request4quote_Model_Adminhtml_Quote_Create
{
    /**
     * @override
     * @return $this
     */
    public function saveCustomer()
    {
        $quote = $this->getQuote();
        if ($quote->getCustomerIsGuest()) {
            return $this;
        }
        $customer = $this->getSession()->getCustomer();
        $store = $this->getSession()->getStore();
        $websiteId = $store->getWebsiteId();
        $accountData = $this->getData('account');
        try {
            if(isset($accountData['email']) && !empty($accountData['email'])) {
                $customerModel = Mage::getModel('customer/customer');
                $customerClass = $customerModel->setWebsiteId($websiteId)->loadByEmail($accountData['email']);
                if(!($customerClass->getId())) {
                    $appEmulation = Mage::getSingleton('core/app_emulation');
                    $initialEnvironmentInfo = $appEmulation->startEnvironmentEmulation($store->getId());
                    $customerModel->setWebsiteId($websiteId);
                    $customerModel->setStore($store);
                    $customerModel->setData($accountData);
                    $customerModel->setPassword($customer->generatePassword());
                    $billing    = $quote->getBillingAddress();
                    $shipping   = $quote->isVirtual() ? null : $quote->getShippingAddress();
                    $customerBilling = $billing->exportCustomerAddress();
                    $customerModel->addAddress($customerBilling);
                    $billing->setCustomerAddress($customerBilling);
                    $customerBilling->setIsDefaultBilling(true);
                    if ($shipping && !$quote->getR4qShippingAsBilling()) {
                        $customerShipping = $shipping->exportCustomerAddress();
                        $customerModel->addAddress($customerShipping);
                        $shipping->setCustomerAddress($customerShipping);
                        $customerShipping->setIsDefaultShipping(true);
                    } else {
                        $customerBilling->setIsDefaultShipping(true);
                    }
                    $customerModel->save();
                    $this->getBillingAddress()->setCustomerId($customerModel->getId());
                    $this->getShippingAddress()->setCustomerId($customerModel->getId());
                    $quote->setCustomer($customerModel);
                    $appEmulation->stopEnvironmentEmulation($initialEnvironmentInfo);
                }
            }
        } catch (Exception $e) {
        }
        return $this;
    }
}