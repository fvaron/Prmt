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
class Promethean_Request4quote_Helper_Data extends ITwebexperts_Request4quote_Helper_Data
{
    /**
     * OVERRIDE
     * Shows drop down of quotes for adding to current quote
     *
     * @return string
     */
    public function getDropdownQuotes(){
        $quoteCollection = Mage::getModel('request4quote/quote')->getCollection()
            ->addFieldToFilter('customer_email', Mage::getSingleton('customer/session')->getCustomer()->getEmail())
            ->setOrder('created_at');
        $dd = '<select name="r4quote" style="float:right;margin-left:3px;"><option value="new">--'.Mage::helper('request4quote')->__('Current Quote').'--</option>';
        foreach($quoteCollection as $iquote){
            $quoteDate = Mage::helper('core')->formatDate($iquote->getCreatedAt());
            $dd .= '<option value="'.$iquote->getId().'">' . Mage::helper('request4quote')->__('Quote #') .$iquote->getId().' - '.$quoteDate.'</option>';
        }
        $dd .= '</select>';
        return $dd;
    }
}