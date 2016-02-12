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
class Promethean_Faq_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Retrieve faq page url
     *
     * @return string
     */
    public function getFaqUrl()
    {
        return $this->_getUrl('faq');
    }
}