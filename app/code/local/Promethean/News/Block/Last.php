<?php
/**
 * This file is part of Promethean_News for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_News
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */

/**
 * Last Block
 * @package Promethean_News
 */
class Promethean_News_Block_Last extends CommerceLab_News_Block_News
{
    /**
     * Construct
     */
    protected function _construct()
    {
        $this->_latestItemsCount = 1;
    }
}