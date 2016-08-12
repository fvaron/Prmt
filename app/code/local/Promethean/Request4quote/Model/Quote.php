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
class Promethean_Request4quote_Model_Quote extends ITwebexperts_Request4quote_Model_Quote
{
    /**
     * Get formated quote created date in store timezone
     *
     * @return  string
     */
    public function getCreatedAtFormated()
    {
        $timestamp = Mage::getModel('core/date')->timestamp(strtotime($this->getCreatedAt()));
        return date('d/m/Y', $timestamp);
    }

    public function getValideDate()
    {
        $timestamp = Mage::getModel('core/date')->timestamp(strtotime($this->getCreatedAt() . ' + 7 days'));
        return date('d/m/Y', $timestamp);
    }
}