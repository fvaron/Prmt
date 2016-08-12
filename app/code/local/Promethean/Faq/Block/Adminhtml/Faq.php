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
class Promethean_Faq_Block_Adminhtml_Faq extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->_controller = 'adminhtml_faq';
        $this->_blockGroup = 'faq';
        $this->_headerText = $this->__('Questions Manager');
        parent::__construct();
    }

    /**
     * Get header CSS class
     *
     * @return string
     */
    public function getHeaderCssClass()
    {
        $headerCss = parent::getHeaderCssClass();
        return $headerCss . ' head-cms-block';
    }
}