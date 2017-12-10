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
class Promethean_Request4quote_Block_Rewrite_Adminhtml_Quote_Create extends ITwebexperts_Request4quote_Block_Adminhtml_Quote_Create
{
    /**
     * @override
     * Ecran_Request4quote_Block_Rewrite_Adminhtml_Quote_Create constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $quote = $this->_getSession()->getQuote();
        $this->_addButton('quote_duplicate', array(
            'label' => Mage::helper('request4quote')->__('Duplicate'),
            'onclick' => "window.location.href = '" . $this->getUrl('adminhtml/quote/duplicate', array('quote_id' => $quote->getId())) . "'; return false;"
        ));
    }
}