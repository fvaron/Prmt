<?php
/**
 * This file is part of Promethean_Faq for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Faq
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */
class Promethean_Faq_Adminhtml_Faq_UpdateOrderController extends Mage_Adminhtml_Controller_action
{
    /**
     * Update questions order action
     */
    public function indexAction()
    {
        $action = $this->getRequest()->getPost('action');
        $updateRecordsArray = $this->getRequest()->getPost('recordsArray');

        if ($action && $action == "updateRecordsListings") {

            $listingCounter = 1;
            try {
                foreach ($updateRecordsArray as $recordIdValue) {

                    $data = array('sort' => $listingCounter);

                    $model = Mage::getModel('faq/faq')->load($recordIdValue)->addData($data);
                    $model->setId($recordIdValue)->save();

                    $listingCounter = $listingCounter + 1;
                }

                $responseBody = '<ul class="messages">
                        <li class="success-msg">
                            <ul>
                                <li>' . Mage::helper('faq')->__('Sort order has been successfully updated.') . '</li>
                            </ul>
                        </li>
                    </ul>';
            } catch (Exception $e) {
                $responseBody = '<ul class="messages">
                        <li class="error-msg">
                            <ul>
                                <li>' . $e->getMessage() . '</li>
                            </ul>
                        </li>
                    </ul>';
            }

            $this->getResponse()->setBody($responseBody);
        }
    }
}