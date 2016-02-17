<?php
/**
 * This file is part of Promethean_System for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_System
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */
class Promethean_System_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Check if homepage
     * @return bool
     */
    public function getIsHomePage()
    {
        $action = Mage::app()->getFrontController()->getAction()->getFullActionName();
        if ($action == 'cms_index_index') {
            return true;
        }
        return false;
    }
}