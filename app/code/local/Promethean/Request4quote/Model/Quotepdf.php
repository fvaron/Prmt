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
class Promethean_Request4quote_Model_Quotepdf extends ITwebexperts_Request4quote_Model_Quotepdf
{
    /**
     * OVERRIDE
     * Render a PDF file and show in browser or save to disk
     * If save to disk return file location
     */

    public function renderRfqRequest($quote, $saveToDisk = false){
        $storeid = $quote->getStoreId();
        if ($storeid) {
            $appEmulation = Mage::getSingleton('core/app_emulation');
            $initial = $appEmulation->startEnvironmentEmulation(
                $storeid, Mage_Core_Model_App_Area::AREA_FRONTEND, true
            );
        }
        $pdf = new TCPDF();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 0);
        $pdf->setHeaderMargin(0);
        $pdf->setFooterMargin(0);
        $pdf->setImageScale(1.5);
        $emailtext = Mage::helper('request4quote/email')->sendRequestProposalNotification($quote, false, true);
        // echo $emailtext;
        $pdf->writeHTML($emailtext, false);
        $pdf->endPage();
        if ($storeid) {
            $appEmulation->stopEnvironmentEmulation($initial);
        }
        $rfqfilename = 'ProInteractive-devis-' . $quote->getId() . '.pdf';
        if(!$saveToDisk) {
            return $pdf->Output($rfqfilename);
        } else if ($saveToDisk){
            $filePath = $this->getFilePath() . $rfqfilename;
            $pdf->Output($filePath, 'F');
            return $filePath;
        }
        exit;
    }
}