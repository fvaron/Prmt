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
class Promethean_Faq_Model_Resource_Faq extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Constructor
     */
    public function _construct()
    {
        $this->_init('faq/faq', 'id');
    }
}