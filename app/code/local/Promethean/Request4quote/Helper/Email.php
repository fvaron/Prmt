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
class Promethean_Request4quote_Helper_Email extends ITwebexperts_Request4quote_Helper_Email
{
    const RFQ_PDF_QUOTE   = 'request4quote/pdf/quote';

    /**
     * OVERRIDE
     * Sends email with quoted prices to customer
     * @param $quote
     * @param null $emailcomment
     * @param bool|false $returnProcessed
     * @return string
     * @throws Exception
     * @throws Mage_Core_Exception
     */

    public function sendRequestProposalNotification($quote, $emailcomment = null, $returnProcessed = false)
    {
        $attachpdf = Mage::helper('request4quote')->enabledAttachments();
        $showcommentspdf = Mage::helper('request4quote')->enabledPdfComments();

        $emailTemplate = $this->setEmailTemplate($quote->getStoreId());
        $emailTemplateVariables = $this->getEmailVariables($quote);
        if ($emailcomment) {
            $emailTemplateVariables['comment'] = '<br />'.Mage::helper('request4quote')->__('Comment: ').$emailcomment.'<br />';
        }
        try {
            if ($showcommentspdf) {
                $commentblock = Mage::app()->getLayout()->createBlock('request4quote/quote_comments', 'commentspdf')
                    ->setTemplate('request4quote/quote/comments.phtml');
                $commentblock->setData('quote_id', $quote->getId());
                $emailTemplateVariables['pdfcomment'] = $commentblock->toHtml();
            }
        }catch(Exception $e){

        }
        $emailTemplateId = Mage::getStoreConfig(self::RFQ_EMAIL_QUOTE_ADMIN, $emailTemplateVariables['store']->getId());
        /** Used for PDF */
        if($returnProcessed){
            /** if_numeric means is a custom email template and needs to load differently than regular */
            if (is_numeric($emailTemplateId)) {
                $emailTemplate->load($emailTemplateId);
            } else {
                $emailTemplate->loadDefault($emailTemplateId);
            }
            return $emailTemplate->getProcessedTemplate($emailTemplateVariables);
        }
        if($attachpdf){
            $emailTemplateIdPdf = Mage::getStoreConfig(self::RFQ_PDF_QUOTE, $emailTemplateVariables['store']->getId());
            $pdffile = Mage::getModel('request4quote/quotepdf')->renderRfqRequest($quote, true);
            $emailTemplate = $this->addFileAttachment($pdffile, $emailTemplate);
        }
        if($this->getRFQbccTo($emailTemplateVariables['store']->getId())) {
            $emailTemplate->addBcc($this->getRFQbccTo($emailTemplateVariables['store']->getId()));
        }
        $emailTemplate->sendTransactional($emailTemplateIdPdf,$this->getSender($emailTemplateVariables['store']->getId()),$quote->getCustomerEmail(),  $emailTemplateVariables['send_to_name'], $emailTemplateVariables, $emailTemplateVariables['store']->getId());
    }

    private function getSender($storeId = null)
    {
        return array(
            'name'=>Mage::getStoreConfig(self::RFQ_SENDER_NAME, $storeId),
            'email'=>Mage::getStoreConfig(self::RFQ_SENDER_EMAIL, $storeId)
        );
    }
}