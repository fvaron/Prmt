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
require_once(BP . DS . 'lib' . DS . 'tcpdf' . DS . 'mypdf.php');

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
        $pdf = new MYPDF();
        $pdf->setPrintHeader(false);
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->setHeaderMargin(0);
        $pdf->SetFooterMargin(5);
        $pdf->SetAutoPageBreak(true, 30);
        $pdf->setImageScale(1.5);
        $pdf->AddPage();
        $emailtext = Mage::helper('request4quote/email')->sendRequestProposalNotification($quote, false, true);
        $pdf->writeHTMLCell(0, 0, '', '', $emailtext, 0, 1, 0, true, '', true);
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