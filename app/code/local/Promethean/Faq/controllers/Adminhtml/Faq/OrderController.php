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
class Promethean_Faq_Adminhtml_Faq_OrderController extends Mage_Adminhtml_Controller_action
{
    /**
     * Init action
     *
     * @return $this
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('cms/faq')
            ->_addBreadcrumb(Mage::helper('faq')->__('Questions sorting'),
                Mage::helper('adminhtml')->__('Questions sorting'));
        return $this;
    }

    /**
     * List
     */
    public function indexAction()
    {
        $this->_initAction()->renderLayout();
    }
}