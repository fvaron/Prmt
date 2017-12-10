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
require_once 'ITwebexperts/Request4quote/controllers/Adminhtml/QuoteController.php';


class Promethean_Request4quote_Adminhtml_Adminhtml_QuoteController extends ITwebexperts_Request4quote_Adminhtml_QuoteController
{
    /**
     * Duplicate quote request
     */
    public function duplicateAction()
    {
        $quoteId = $this->getRequest()->getParam('quote_id');
        try {
            if ($quoteId) {
                $quoteToDuplicate = Mage::getModel('request4quote/quote')->loadByIdWithoutStore($quoteId);
                $billingAddressData = $quoteToDuplicate->getBillingAddress()->getData();
                $shippingAddressData = $quoteToDuplicate->getShippingAddress()->getData();
                $items = $quoteToDuplicate->getAllItems();
                $newQuoteData = $quoteToDuplicate->getData();
                unset($newQuoteData['entity_id']);
                $newQuote = Mage::getModel('request4quote/quote')->setData($newQuoteData);
                // Add billing address
                unset($billingAddressData['address_id']);
                unset($billingAddressData['quote_id']);
                $billingAddress = Mage::getModel('sales/quote_address')
                    ->setData($billingAddressData)
                    ->setAddressType(Mage_Sales_Model_Quote_Address::TYPE_BILLING);
                $newQuote->setBillingAddress($billingAddress);
                // Add shipping address
                unset($shippingAddressData['address_id']);
                unset($shippingAddressData['quote_id']);
                $shippingAddress = Mage::getModel('sales/quote_address')
                    ->setData($shippingAddressData)
                    ->setAddressType(Mage_Sales_Model_Quote_Address::TYPE_SHIPPING);
                $newQuote->setShippingAddress($shippingAddress);
                // Add Items
                foreach($items as $item) {
                    $item->setData('item_id', null);
                    $item->setData('quote_id', null);
                    $newQuote->addItem($item);
                }
                $newQuote->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Request quote has been duplicate')
                );
            }
        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Exception $e) {
            $this->_getSession()->addError($e->getMessage());
            Mage::logException($e);
        }
        $this->_redirect('*/*/');
    }
}