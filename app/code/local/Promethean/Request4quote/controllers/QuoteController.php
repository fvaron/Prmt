<?php
/**
 * This file is part of Promethean_Request4quote for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Request4quote
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */
require_once 'ITwebexperts/Request4quote/controllers/QuoteController.php';


class Promethean_Request4quote_QuoteController extends ITwebexperts_Request4quote_QuoteController
{
    /**
     * OVERRIDE
     */
    public function indexAction()
    {
        // Add redirect to quote
        Mage::getSingleton('customer/session')->setBeforeAuthUrl(Mage::getUrl('*/*/*', array('_secure' => true)));

        $cart = $this->_getCart();
        if ($cart->getQuote()->getItemsCount()) {
            $cart->init();
            $cart->save();
        }

        // Compose array of messages to add
        $messages = array();
        foreach ($cart->getQuote()->getMessages() as $message) {
            if ($message) {
                // Escape HTML entities in quote message to prevent XSS
                $message->setCode(Mage::helper('core')->escapeHtml($message->getCode()));
                $messages[] = $message;
            }
        }
        $cart->getCheckoutSession()->addUniqueMessages($messages);

        /**
         * if customer enteres shopping cart we should mark quote
         * as modified bc he can has checkout page in another window.
         */
        $this->_getSession()->setCartWasUpdated(true);

        Varien_Profiler::start(__METHOD__ . 'r4q_display');
        $this
            ->loadLayout()
            ->_initLayoutMessages('request4quote/session')
            ->_initLayoutMessages('catalog/session')
            ->getLayout()->getBlock('head')->setTitle($this->__('Request for Quote'));
        $this->renderLayout();
        Varien_Profiler::stop(__METHOD__ . 'r4q_display');
    }

    /**
     * OVERRIDE
     * Processes billing/shipping addresses as well as the other parameters.
     * @param $quote
     */
    protected function _sendCart($quote){
        $r4qData = $this->getRequest()->getPost('r4q');
        if (isset($r4qData['details']) && is_array($r4qData['details'])) {

            $billingAddress = $quote->getBillingAddress();
            $shippingAddress = $quote->getShippingAddress();

            if (isset($r4qData['details']['remark']) && $r4qData['details']['remark'] != '') {
                $this->insertComment($r4qData['details']['remark'], $quote->getId());
            }

            if (isset($r4qData['billing']) && is_array($r4qData['billing'])) {

                $this->_prepareAddress($billingAddress, $quote, $r4qData['details'], $r4qData['billing']);

                $shippingSameAsBilling = false;
                if (isset($r4qData['billing']['shipping_same_as_billing'])) {
                    $shippingSameAsBilling = (bool)$r4qData['billing']['shipping_same_as_billing'];
                }

                if ($shippingSameAsBilling) {
                    $quote->setR4qShippingAsBilling(1);
                    $quote->getShippingAddress()->setShippingAsBilling(1);
                    $this->_prepareAddress($shippingAddress, $quote, $r4qData['details'], $r4qData['billing']);
                }
                elseif (isset($r4qData['shipping']) && is_array($r4qData['shipping'])) {
                    $this->_prepareAddress($shippingAddress, $quote, $r4qData['details'], $r4qData['shipping']);
                    $shippingAddress->setSameAsBilling(false);
                }
            }

            $quote->setData('r4q_status', ITwebexperts_Request4quote_Model_Quote::STATUS_PROCESSED);
            $quote->setData('r4q_token', sha1(time() . rand(1000000000, 9999999999) . rand(1000000000, 9999999999)));
            $quote->setIsActive(false);

            /** Check if in guest quote mode if the email address used has a customer record, if so tie the
             * quote to that customer (so not an orphaned guest quote) */
            if(!$this->_getSession()->getCustomer()) {
                $email = $r4qData['details']['email'];
                $customer = Mage::getModel("customer/customer")->setWebsiteId(Mage::app()->getWebsite()->getId())->loadByEmail($email);
                if ($customer) {
                    $quote->setCustomerId($customer->getId())->setCustomerGroupId($customer->getGroupId());
                }
            }


            // save quote
            $quote->save();
        }

        if (isset($r4qData['item']) && is_array($r4qData['item'])) {
            foreach ($r4qData['item'] AS $itemId => $data) {
                $quoteItem = Mage::getModel('request4quote/quote_item')->load($itemId);
                if ($quoteItem->getQuoteId() == $quote->getId()) {
                    if (isset($data['remark'])) {
                        $dataEmails = Mage::getStoreConfig(Mage_Sales_Model_Order::XML_PATH_EMAIL_COPY_TO, Mage::app()->getStore()->getId());
                        if (!empty($dataEmails)) {
                            $emails =  explode(',', $dataEmails);
                        };
                        mail($emails[0], 'Devis n° ' . $quote->getId() . ' remarque du produit ' .$quoteItem->getName(), $data['remark']);
                        $quoteItem->setQuote($quote);
                        $quoteItem->setData('r4q_note', $data['remark']);
                        $quoteItem->save();
                    }
                } else {
                    // Exception
                }
            }
        }
        Mage::helper('request4quote/email')->sendRequestProposalNotification($quote, '');
        // cleanup session
        $this->_getSession()->clear();
        $this->_getSession()->setLastSuccessQuoteId($quote->getId());
        // success redirect
        $this->_redirect('request4quote_front/quote/success');
    }

    /**
     * OVERRIDE
     */
    public function successAction()
    {
        if (!$this->_getSession()->getLastSuccessQuoteId()) {
            $this->_redirect('');
        }

        $this->loadLayout()
            ->_initLayoutMessages('request4quote/session')
            ->_initLayoutMessages('catalog/session');
        $this->renderLayout();
        $this->_getSession()->clear();
    }
}