<?php
/**
 * This file is part of Promethean_AjaxNewsletter for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_AjaxNewsletter
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */
require_once 'Mage/Newsletter/controllers/SubscriberController.php';

class Promethean_AjaxNewsletter_SubscriberController extends Mage_Newsletter_SubscriberController
{
    /**
     * New subscription action
     */
    public function newAction()
    {
        parent::newAction();

        /**
         * Handle Ajax requests
         */
        if ($this->getRequest()->isAjax()) {

            /**
             * Remove all header in order to avoid redirect of parent method
             */
            $this->getResponse()->clearAllHeaders();

            /**
             * Retrieve last message from session
             */
            $message = Mage::getSingleton('core/session')->getMessages(true)->getLastAddedMessage();

            /**
             * Build response
             */
            $response = array(
                'message' => $message->getText(),
                'error' => (string) ($message->getType() == Mage_Core_Model_Message::ERROR) ? true : false
            );

            /**
             * Send JSON response
             */
            $this->getResponse()->setHeader('Content-type', 'application/json');
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
        }
    }
}